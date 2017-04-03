<template>
    <div>
    wut    
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
            }
            
        },
        

        data() {
            return {
                tasks: '',
                loading: true,
                current: 0,
                
            }
        },


        created() {

            axios.get('api/task/' + this.courseid)
                .then(response => {
                    this.tasks = response.data;
                    this.loading = false;
                    console.log('this.tasks');
                })
                .catch(error => console.log(error));
            
        }
    }
</script>
