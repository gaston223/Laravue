<template>
    <div>
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form >
                            <div class="form-group">
                                <label for="name">Nom de la tâche</label>
                                <textarea v-model="taskToEdit.name" class="form-control" name="name" id="name" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" data-dismiss="modal" @click="update">Enregistrer ma tâche</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['taskToEdit'],
        methods:{
            update(){
                axios.patch('/tasksList/update/'+this.taskToEdit.id, {
                    name: this.taskToEdit.name
                })
                .then(response => {
                    return $this.$emit('task-updated', response);
                })
                .catch(error => console.log(error))
            },
        }
    }



</script>
