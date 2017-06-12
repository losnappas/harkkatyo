<template>
    <div>
        <div v-if="loading==false">


            <div v-if="current < tasks.length">
            <h4>
                Task: {{tasks[current].title}}
            </h4><br/>
            <p v-html="strip(this.tasks[this.current].body)"></p>
            <input v-model="answer" placeholder="answer" value="answer" ref="answer" @keyup.enter="checkAnswer2(answer)"
              @keydown="clear" />
            <button v-on:click="checkAnswer2(answer)">Submit</button>

            </div>
            <div v-else>All done. It's time to <a :href="href">head back</a></div>
        </div>
        <div :class="className" v-if="message.length > 1">
        {{message}}
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>

        <div class="alert alert-warning">
        <strong><u>Your answer resulted: </u></strong><br/>
        <div v-if="reply.length>0">{{reply}}</div>
        <div id="reply"></div>
        </div>

        <div class="alert alert-info">
        <strong><u>Desired result is: </u></strong><br/>
        <div id="realAnswer"></div>
        </div>
       

        <div v-if="loading == true">Please wait while loading data...</div>

        <div v-if="tasks.lenght == 0 && loading == false">There were no tasks...</div>

        opiskelijat: <br/> <div id="opiskelijat"></div> <br/>
        kurssit: <br/> <div id="kurssit"></div> <br/>
        suoritukset: <br/> <div id="suoritukset"></div>
    </div>
</template>
<script>
    export default {

        props: {
            courseid: {
                type: String,
                required: true,
            },
            sessionid: {
                type: String,
                required: true,
            },            
        },
        

        data() {
            return {
                tasks: [],
                loading: true,
                current: 0,
                message: '',
                answer: '', //query
                reply: '', //db answer to query
                realAnswer: '', //db answer to the correct query
                tries: 0,
                count: 0, //count of correct answers
                attempt: null,
            }
        },

        created() {
            axios.get('/courses/' +this.courseid+'/tasks')
                .then(response => {
                    this.tasks = response.data;
                    this.loading = false;

                    this.start();
                    
                })
                .catch(error => console.log(error));

            

        },
        computed:{
            href(){
                return '/courses/'+this.courseid;
            },


            className(){
                if (this.tries>0) {
                    return 'alert alert-warning';
                }
                else if (this.tries==0) {
                    return 'alert alert-success';
                }
                else if (this.tries==-1) {
                    this.tries=0;
                    return 'alert alert-info';
                }
            }
        },
        methods:{
            //need to:
            //  'post' answer given & answer in answer table
            //  compare what database answers to each
            //  print both db answers
            checkAnswer2: function(answer){
                //check the answer
                let dbAnswer = 'not working?';
                let wasCorrect = false;
                this.reply='';
                axios.get('/tiko/answer/'+this.tasks[this.current].id)
                    .then(response => {
                        dbAnswer = response.data.dbAnswer[0].body;

                    //post both answers
                    axios.all([
                        axios.post('/tiko/answered', {body: dbAnswer}),
                        axios.post('/tiko/answered', {body: answer})
                    ])
                    .then(axios.spread((dbResponse, userResponse) => {

                        if (JSON.stringify(userResponse.data.dbAnswer) === 
                                JSON.stringify(dbResponse.data.dbAnswer)) {

                            this.tries=0;
                            wasCorrect = true;
                            this.current++;
                            this.message = 'Correct!';
                            this.count++;
                            this.answer='';
                        }else{
                            wasCorrect = false;
                            if (this.tries===2) {
                                this.message = 'The correct answer was: '+dbAnswer;
                                this.current++;
                                this.tries = -1;
                            }else{
                                this.tries++;
                                this.message = 'Try again.';
                            }
                        }
                        this.$refs.answer.focus();


                        //register the attempt
                        axios.post('/tiko/attempt', 
                            {
                                body: answer, correct: wasCorrect, count: this.count,
                                attempt: this.attempt,
                            })
                            .then(response => {
                                this.start();

                            })
                            .catch(error => console.error('attempt: ',error));
                        if (this.current >= this.tasks.length) {
                            this.done();
                        }
                        if (userResponse.data.dbAnswer.indexOf("STATE")===-1)
                            this.print(userResponse.data.dbAnswer, 'reply');
                        else
                            this.reply = userResponse.data.dbAnswer;

                        this.print(dbResponse.data.dbAnswer, 'realAnswer');
                    }))
                    .catch(error => {
                        console.error('in inner error: ',error)
                    });



                    })
                    .catch(error => console.error('in error: ', error));
                    
                                    
            },

            //start an attempt
            start: function(){
                //create the attempt
                axios.post('/tiko/attempt/start', {
                    task: this.tasks[this.current].id,
                    session: this.sessionid,
                })
                .then(response => {
                    this.attempt = response.data;
                })
                .catch(error => console.error('attempt create err: ', error,
                        this.sessionid, this.tasks[this.current].id));

                //print the tables for display . . .
                axios.get('/tiko/display')
                    .then(response => {
                        this.print(response.data.opiskelijat, 'opiskelijat');
                        this.print(response.data.kurssit, 'kurssit');
                        this.print(response.data.suoritukset, 'suoritukset');
                    })
                    .catch(error => console.error('disp.', error));
            },



            done: function(){
                axios.post('/tiko/session/done', {session: this.sessionid})
                .catch(error => console.error('done error: ', error));
            },

            strip: function(str){
			if(!isNaN(str)) return str;
                  var allowed = '<h1><b><strike><p>';
                  allowed = (((allowed || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('')
                  var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi
                  var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi
                  return str.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
                    return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : ''
                  })
              
            },
            clear: function (){
                if (this.message.length>0)
                    this.message='';
            },

            print: function(givenTable, idName){
                // EXTRACT VALUE FOR HTML HEADER. 
		// ('Book ID', 'Book Name', 'Category' and 'Price')
		var col = [];
		for (var i = 0; i < givenTable.length; i++) {
		    for (var key in givenTable[i]) {
			if (col.indexOf(key) === -1) {
			    col.push(this.strip(key));
			}
		    }
		}

		// CREATE DYNAMIC TABLE.
		var table = document.createElement("table");

		// CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

		var tr = table.insertRow(-1);                   // TABLE ROW.

		for (var i = 0; i < col.length; i++) {
		    var th = document.createElement("th");      // TABLE HEADER.
		    th.innerHTML = col[i];
		    tr.appendChild(th);
		}

		// ADD JSON DATA TO THE TABLE AS ROWS.
		for (var i = 0; i < givenTable.length; i++) {

		    tr = table.insertRow(-1);

		    for (var j = 0; j < col.length; j++) {
			var tabCell = tr.insertCell(-1);
			tabCell.innerHTML = this.strip(givenTable[i][col[j]]);
		    }
		}
		// FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
		var divContainer = document.getElementById(idName);
		divContainer.innerHTML = "";
		divContainer.appendChild(table);
	    }

        }

    }
</script>
<style>
    .closebtn{
        margin-left: 15px;
        color: black;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
    }

    table, th, td{
        border: 1px solid black;
    }
    table{
        width: 100%;
    }
    th{
        height: 50px;
    }
</style>
