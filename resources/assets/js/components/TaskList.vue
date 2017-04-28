<template>
    <div>
        <div v-if="loading==false">


            <div v-if="current < tasks.length">
            <h4>
                Task: {{tasks[current].title}}
            </h4><br/>
            <p v-html="strip()"></p>
            <input v-model="answer" placeholder="answer" value="answer" ref="answer" @keyup.enter="checkAnswer(answer)"
              @keydown="clear" />
            <button v-on:click="checkAnswer(answer)">Submit</button>

            </div>
            <div v-else>All done. It's time to <a :href="href">head back</a></div>
        </div>
        <div :class="className" v-if="message.length > 1">
        {{message}}
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
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
            url: {
                type: String,
                required: true
            }
            
        },
        

        data() {
            return {
                tasks: [],
                loading: true,
                current: 0,
                message: '',
                answer: '',
                tries: 0,
            }
        },

        created() {

            axios.get(this.url+'/tasks')
                .then(response => {
                    this.tasks = response.data;
                    this.loading = false;
                })
                .catch(error => console.log(error));

        },
        computed:{
            href(){
                return this.url;
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
            checkAnswer: function (answer){
                if(this.tasks[this.current].answer == answer){
                    this.message = 'Correct!';
                    this.current++;
                    this.tries = 0;
                } else if (this.tries==2) {
                    this.message = 'The correct answer was: '+this.tasks[this.current].answer;
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