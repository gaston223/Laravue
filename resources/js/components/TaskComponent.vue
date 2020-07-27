<template>
    <div class="container mt-2">
        <add-task @task-added="refresh"></add-task>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center" v-for="task in tasks.data" :key="task.id">
                <a href="#">{{ task.name }}</a>
                <div>
                    <button @click="getTask(task.id)" type="button" class="btn btn-warning btn-sm m2" data-toggle="modal" data-target="#editModal">
                        Editer
                    </button>
                    <button @click="deleteTask(task.id)" type="button" class="btn btn-danger btn-sm" >
                    supprimer
                </button>
                </div>

            </li>
            <edit-task v-bind:taskToEdit="taskToEdit" @task-updated="refresh"></edit-task>
        </ul>

        <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                tasks: {},
                taskToEdit: ''
            }
        },
        created() {
            axios.get('http://127.0.0.1:8000/tasksList')
                .then(response => (this.tasks = response.data))
                .catch(error => console.log(error))
        },

        methods:{
            getResults(page = 1) {
                axios.get('http://127.0.0.1:8000/tasksList?page=' + page)
                    .then(response => {
                        (this.tasks = response.data);
                    });
            },

            deleteTask(id){
                axios.delete('http://127.0.0.1:8000/tasks/delete/'+id)
                .then(response => this.tasks = response.data)
                .catch(error => console.log(error));
            },

            refresh(tasks){
                this.tasks = tasks.data
            },
            getTask(id){
                axios.get('http://127.0.0.1:8000/tasksList/edit/'+id)
                .then(response => (this.taskToEdit = response.data))
                .catch(error => console.log(error))
            },

        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
