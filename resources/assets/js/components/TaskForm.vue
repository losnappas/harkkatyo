<template>
    <div>
        <h4>Answer the question</h4>
        <form v-on:submit.prevent="checkAnswer" @keydown="errors = []">
            <div :class="className">
                <label class="control-label" for="answer">Your answer:</label>
                <input class="form-control" type="text" name="answer" id="answer" v-model="answer">
            </div>

            <div class="alert alert-danger" v-if="errors.length">
                <ul>
                    <li v-for="error in errors">{{error}}</li>
                </ul>
            </div>

            <button type="submit" class="btn btn-primary" :disabled="errors.length > 0">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {

        props: ['task', 'answer'],

        data() {
            return {
                answer1: '',
                errors: []
            }
        },
        methods: {
                checkAnswer() {
                    axios.post('/tasks/'+this.taskid+'/answer', {answer:this.answer})
                        .then(response => {
                            bus.$emit('next-task', this.answer, response.data.id);
                            this.answer = '';
                        })
                        .catch(error => {
                            this.errors = error.response.data.answer;
                        });
                }
            
        },
        computed: {

            className() {
                if(this.errors.length > 0) {
                    return 'form-group has-error';
                }

                return 'form-group';
            }
        }
    }
</script>
<style>
    button{
        float: right;
    }
</style>