<template>
    <div>
        <div v-if="loading==false">


            <div v-if="current < tasks.length">
            <h4>
                Task: {{tasks[current].title}}
            </h4><br/>
            <p v-html="strip()"></p>
            <input v-model="answer" placeholder="answer" value="answer" ref="answer" @keyup.enter="checkAnswer2(answer)"
              @keydown="clear" />
            <button v-on:click="checkAnswer2(answer)">Submit</button>

            </div>
            <div v-else>{{this.done()}}All done. It's time to <a :href="href">head back</a></div>
        </div>
        <div :class="className" v-if="message.length > 1">
        {{message}}
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>

        <div class="alert alert-warning" v-if="reply.length > 1">
        <strong><u>Your answer resulted: </u></strong><br/>
        {{reply}}
        </div>

        <div class="alert alert-info" v-if="realAnswer.length > 1">
        <strong><u>Correct result is: </u></strong><br/>
        {{realAnswer}}
        </div>
       

        <div v-if="loading == true">Please wait while loading data...</div>

        <div v-if="tasks.lenght == 0 && loading == false">There were no tasks...</div>


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
                axios.get('/tiko/answer/'+this.tasks[this.current].id)
                    .then(response => {
                        dbAnswer = response.data.dbAnswer[0].body;
                        console.log('fetched correct dbanswer var: ', dbAnswer);

                    axios.all([
                        axios.post('/tiko/answered', {body: dbAnswer}),
                        axios.post('/tiko/answered', {body: answer})
                    ])
                    .then(axios.spread((dbResponse, userResponse) => {

                        if (JSON.stringify(userResponse.data.dbAnswer) == 
                                JSON.stringify(dbResponse.data.dbAnswer)) {
                            console.log('nice');
                            //copy paste (almost) checkAnswer things.
                            this.tries=0;
                            wasCorrect = true;
                            this.current++;
                            this.message = 'Correct!';
                            this.count++;
                        }else{
                            console.log('not nice');
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

                        //register the attempt
                        axios.post('/tiko/attempt', 
                            {
                                body: answer, correct: wasCorrect, count: this.count,
                                attempt: this.attempt,
                            })
                            .then(response => {
                                console.log('attempt', response.data.dbAnswer);
                                this.start();
                            })
                            .catch(error => console.error('attempt: ',error));
                        


                        this.reply = userResponse.data.dbAnswer;
                        this.realAnswer = dbResponse.data.dbAnswer;
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
            },



            done: function(){
                axios.post('/tiko/session/done', {session: this.sessionid})
                .then(response => console.log(response.data))
                .catch(error => console.error('done error: ', error));
            },



            checkAnswer: function (answer){
                if(this.tasks[this.current].answer == answer){
                    this.message = 'Correct!';
                    this.current++;
                    this.tries = 0;
                } else if (this.tries==2) {
                    this.message = 'The correct answer was: '+this.tasks[this.current].answers;
                    this.current++;
                    this.tries = -1;
                } else {
                    this.message = 'Wrong answer, try again.';
                    this.tries++;
                }
                this.answer='';
                this.$refs.answer.focus();
            },

            strip: function(){
                  var allowed = '<h1><b><strike><p>';
                  allowed = (((allowed || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('')
                  var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi
                  var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi
                  return this.tasks[this.current].body.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
                    return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : ''
                  })
              
            },
            clear: function (){
                if (this.message.length>0)
                    this.message='';
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
</style>