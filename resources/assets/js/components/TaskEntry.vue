<template>
<div>
            
    <h4><b>{{ task.title }}</b></h4> <br /> 
    {{task.body}} 
    
    

    <p>{{task.body}}</p>
           
</div>
</template>
<script>
    export default {
        props: ['task', 'answer'],

        methods: {
            answerTask(task){
                this.$emit('next-task', task);
            }
        }
        
    }
</script>
