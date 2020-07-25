<template>
    <div class="container mt-2">
        <ul class="list-group">
            <li class="list-group-item" v-for="task in tasks.data" :key="task.id">
                <a href="#">{{ task.name }}</a>
            </li>
        </ul>

        <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
    </div>

</template>

<script>
    export default {

        data(){
            return {
                tasks: {}
            }
        },

        methods:{
            getResults(page = 1) {
                axios.get('http://127.0.0.1:8000/tasksList?page=' + page)
                    .then(response => {
                        this.tasks = response.data;
                    });
            }
        },
        created() {
          axios.get('http://127.0.0.1:8000/tasksList')
            .then(response => this.tasks = response.data)
            .catch(error => console.log(error))
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
