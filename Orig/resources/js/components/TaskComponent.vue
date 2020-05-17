<template>
    <div>
        <div v-if="!loading">
            <img class="rounder mx-auto d-block" :src="image" alt="loading" />
        </div>

        <div v-else>
          <button @click="createModal" class="btn btn-success btn-block" type="button">Add New Task</button>

          <table class="table" v-if="tasks">
              <thead>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Body</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
              </thead>
              <tbody>
                  <tr v-for="(task, index) in tasks">
                      <td>{{ index + 1 }}</td>
                      <td>{{ task.name }}</td>
                      <td>{{ task.body }}</td>
                      <td><button class="btn btn-info">Edit</button></td>
                      <td><button class="btn btn-danger">Remove</button></td>
                  </tr>
              </tbody>
          </table>

          <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Create Modal</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>

                      <div class="modal-body">
                          <div class="form-group">
                              <label for="name">Name</label>
                              <input v-model="task.name" type="text" id="name" class="form-control">
                          </div>
                          <div class="form-group">
                              <label for="description">Description</label>
                              <input v-model="task.body" type="text" id="description" class="form-control">
                          </div>
                      </div>

                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button @click="createTask" type="button" class="btn btn-primary">Save changes</button>
                      </div>
                  </div>
              </div>
          </div>

        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return {
                task:{
                    name: "",
                    body: ""
                },
                tasks: [],
                uri: 'http://127.0.0.1:8000/tasks',
                image: 'img/loading.gif',
                loading: false
            };
        },

        methods:{
            createModal(){
                $("#create-modal").modal("show");
            },

            createTask(){
                axios.get(this.uri, {name: this.task.name, body: this.task.body})
                .then(response=>{
                    this.resetData();
                    $("#create-modal").modal("hide");
                    toastr.success(response.data.message);
                });
            },

            loadTask(){
                axios.get(this.uri).then(response => {
                    this.tasks = response.data.tasks;
                    this.loading = true;
                });
            },

            resetData(){
                this.task.name = '';
                this.task.body = '';
            }
        },

        mounted(){
            this.loadTask();
        }
    }
</script>
