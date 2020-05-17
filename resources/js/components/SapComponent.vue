<template>
  <div>
    <div v-if="!loading">
      <img class="rounder mx-auto d-block" :src="image" alt="loader" />
    </div>

    <div v-else>
      <button @click="createModal" class="btn btn-success btn-block">Add New Person</button>
      <table class="table" v-if="saps">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Birthday</th>
            <th>Recevied</th>
            <th>Recevied Where</th>
            <th>Recevied When</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(sap, index) in saps">
            <td>{{ index + 1 }}</td>
            <td>{{ sap.lastName }}, {{ sap.firstName }} {{ sap.middleName }}.</td>
            <td>{{ sap.gender }}</td>
            <td>{{ sap.birthMonth }} {{ sap.birthDay }}, {{ sap.birthYear }}</td>
            <td>{{ sap.received }}</td>
            <td>{{ sap.receivedWhere }}</td>
            <td>{{ sap.receivedWhen }}</td>
            <td>
              <button @click="updateModal(index)" class="btn btn-info">Edit</button>
            </td>
            <td>
              <button @click="deleteSap(index)" class="btn btn-danger">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Modal -->
      <div
        class="modal fade"
        id="create-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Modal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger" v-if="errors.length > 0">
                <ul>
                  <li v-for="error in errors">{{ error }}</li>
                </ul>
              </div>
              <div class="form-group">
                <label for="firstName">First Name</label>
                <input v-model="sap.firstName" type="text" id="firstName" class="form-control" />
              </div>
              <div class="form-group">
                <label for="lastName">Last Name</label>
                <input v-model="sap.lastName" type="text" id="lastName" class="form-control" />
              </div>
              <div class="form-group">
                <label for="middleName">Middle Name</label>
                <input v-model="sap.middleName" type="text" id="middleName" class="form-control" />
              </div>
              <div class="form-group">
                <label for="gender">Gender</label>
                <select v-model="sap.gender" name="gender" id="gender" class="form-control">
                    <option value="Male" selected="selected">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                </select>
              </div>
              <div class="form-group">
                <label for="birthDay">Birth Day</label>
                <!--- <select v-model="sap.birthDay" name="birthDay" id="birthDay" class="form-control">
                </select> -->
                <input v-model="sap.birthDay" type="text" id="birthDay" class="form-control" />
              </div>
              <div class="form-group">
                <label for="birthMonth">Birth Month</label>
                <!--- <select v-model="sap.birthMonth" name="birthMonth" id="birthMonth" class="form-control">
                </select> -->
                <input v-model="sap.birthMonth" type="text" id="birthMonth" class="form-control" />
              </div>
              <div class="form-group">
                <label for="birthYear">Birth Year</label>
                <!--- <select v-model="sap.birthYear" name="birthYear" id="birthYear" class="form-control">
                </select> -->
                <input v-model="sap.birthYear" type="text" id="birthYear" class="form-control" />
              </div>
              <div class="form-group">
                <label for="recevied">Received</label>
                <input v-model="sap.received" type="text" id="received" class="form-control" />
              </div>
              <div class="form-group">
                <label for="receivedWhere">Received Where</label>
                <input v-model="sap.receivedWhere" type="text" id="receivedWhere" class="form-control" />
              </div>
              <div class="form-group">
                <label for="receivedWhen">Received When</label>
                <input v-model="sap.receivedWhen" type="text" id="receivedWhen" class="form-control" />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button @click="createSap" type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div
        class="modal fade"
        id="update-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Modal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger" v-if="errors.length > 0">
                <ul>
                  <li v-for="error in errors">{{ error }}</li>
                </ul>
              </div>
              <div class="form-group">
                <label for="firstName">First Name</label>
                <input v-model="new_update_sap.firstName" type="text" id="firstNameU" class="form-control" />
              </div>
              <div class="form-group">
                <label for="lastName">Last Name</label>
                <input v-model="new_update_sap.lastName" type="text" id="lastNameU" class="form-control" />
              </div>
              <div class="form-group">
                <label for="middleName">Middle Name</label>
                <input v-model="new_update_sap.middleName" type="text" id="middleNameU" class="form-control" />
              </div>
              <div class="form-group">
                <label for="gender">Gender</label>
                <input v-model="new_update_sap.gender" type="text" id="genderU" class="form-control" />
              </div>
              <div class="form-group">
                <label for="birthDay">Birth Day</label>
                <input v-model="new_update_sap.birthDay" type="text" id="birthDayU" class="form-control" />
              </div>
              <div class="form-group">
                <label for="birthMonth">Birth Month</label>
                <input v-model="new_update_sap.birthMonth" type="text" id="birthMonthU" class="form-control" />
              </div>
              <div class="form-group">
                <label for="birthYear">Birth Year</label>
                <input v-model="new_update_sap.birthYear" type="text" id="birthYearU" class="form-control" />
              </div>
              <div class="form-group">
                <label for="received">Received</label>
                <input v-model="new_update_sap.received" type="text" id="receivedU" class="form-control" />
              </div>
              <div class="form-group">
                <label for="receivedWhere">Received Where</label>
                <input v-model="new_update_sap.receivedWhere" type="text" id="receivedWhereU" class="form-control" />
              </div>
              <div class="form-group">
                <label for="receivedWhen">Received When</label>
                <input v-model="new_update_sap.receivedWhen" type="text" id="receivedWhenU" class="form-control" />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button @click="updateSap" type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      sap: {
        firstName: "",
        lastName: "",
        middleName: "",
        gender: "",
        birthDay: "",
        birthMonth: "",
        birthYear: "",
        received: "",
        receivedWhere: "",
        receivedWhen: ""
      },
      saps: [],
      uri: "http://127.0.0.1:8000/saps/",
      errors: [],
      new_update_sap: [],
      image: "img/loader1.gif",
      loading: false,
      toastr: (toastr.options = { positionClass: "toast-top-full-width" })
    };
  },

  methods: {
    createModal() {
      $("#create-modal").modal("show");
    },

    updateModal(index) {
      this.errors = [];
      $("#update-modal").modal("show");
      this.new_update_sap = this.saps[index];
    },

    loadSap() {
      axios.get(this.uri).then(response => {
        this.saps = response.data.saps;
        this.loading = true;
      });
    },

    createSap() {
      axios
        .post(this.uri, {
          firstName: this.sap.firstName,
          lastName: this.sap.lastName,
          middleName: this.sap.middleName,
          gender: this.sap.gender,
          birthDay: this.sap.birthDay,
          birthMonth: this.sap.birthMonth,
          birthYear: this.sap.birthYear,
          received: this.sap.received,
          receivedWhere: this.sap.receivedWhere,
          receivedWhen: this.sap.receivedWhen
        })
        .then(response => {
          this.resetData();
          this.saps.push(response.data.sap);
          $("#create-modal").modal("hide");
          toastr.success(response.data.message);
        })

        .catch(error => {
          if (error.response.data.errors.firstName) {
            this.errors.push(error.response.data.errors.firstName[0]);
          }

          if (error.response.data.errors.lastName) {
            this.errors.push(error.response.data.errors.lastName[0]);
          }

          if (error.response.data.errors.middleName) {
            this.errors.push(error.response.data.errors.middleName[0]);
          }

          if (error.response.data.errors.gender) {
            this.errors.push(error.response.data.errors.gender[0]);
          }

          if (error.response.data.errors.birthDay) {
            this.errors.push(error.response.data.errors.birthDay[0]);
          }

          if (error.response.data.errors.birthMonth) {
            this.errors.push(error.response.data.errors.birthMonth[0]);
          }

          if (error.response.data.errors.birthYear) {
            this.errors.push(error.response.data.errors.birthYear[0]);
          }

          if (error.response.data.errors.received) {
            this.errors.push(error.response.data.errors.received[0]);
          }

          if (error.response.data.errors.receivedWhere) {
            this.errors.push(error.response.data.errors.receivedWhere[0]);
          }

          if (error.response.data.errors.receivedWhen) {
            this.errors.push(error.response.data.errors.receivedWhen[0]);
          }
        });
    },

    updateSap(){
        axios.patch(this.uri + this.new_update_sap.id, {
            firstName: this.new_update_sap.firstName,
            lastName: this.new_update_sap.lastName,
            middleName: this.new_update_sap.middleName,
            gender: this.new_update_sap.gender,
            birthDay: this.new_update_sap.birthDay,
            birthMonth: this.new_update_sap.birthMonth,
            birthYear: this.new_update_sap.birthYear,
            received: this.new_update_sap.received,
            receivedWhere: this.new_update_sap.receivedWhere,
            receivedWhen: this.new_update_sap.receivedWhen
        }).then(response => {
            $("#update-modal").modal("hide");
            toastr.success(response.data.message);
        }).catch(error=>{

            this.errors = [];
            if (error.response.data.errors.firstName) {
              this.errors.push(error.response.data.errors.firstName[0]);
            }

            if (error.response.data.errors.lastName) {
              this.errors.push(error.response.data.errors.lastName[0]);
            }

            if (error.response.data.errors.middleName) {
              this.errors.push(error.response.data.errors.middleName[0]);
            }

            if (error.response.data.errors.gender) {
              this.errors.push(error.response.data.errors.gender[0]);
            }

            if (error.response.data.errors.birthDay) {
              this.errors.push(error.response.data.errors.birthDay[0]);
            }

            if (error.response.data.errors.birthMonth) {
              this.errors.push(error.response.data.errors.birthMonth[0]);
            }

            if (error.response.data.errors.birthYear) {
              this.errors.push(error.response.data.errors.birthYear[0]);
            }

            if (error.response.data.errors.received) {
              this.errors.push(error.response.data.errors.received[0]);
            }

            if (error.response.data.errors.receivedWhere) {
              this.errors.push(error.response.data.errors.receivedWhere[0]);
            }

            if (error.response.data.errors.receivedWhen) {
              this.errors.push(error.response.data.errors.receivedWhen[0]);
            }
        })
    },

    deleteSap(index){

        let confirmBox = confirm("Do you really want to delete this?");

        if(confirmBox == true){
            axios.delete(this.uri + this.saps[index].id)
            .then(response=>{
                this.$delete(this.saps, index);
                toastr.success(response.data.message);
            }).catch(error =>{
                console.log("Could not delete for some reason")
            });
        }
    },

    resetData() {
      this.sap.firstName = "",
      this.sap.lastName = "",
      this.sap.middleName = "",
      this.sap.gender = "",
      this.sap.birthDay = "",
      this.sap.birthMonth = "",
      this.sap.birthYear = "",
      this.sap.received = "",
      this.sap.receivedWhere = "",
      this.sap.receivedWhen = ""
    }
  },

  mounted() {
      this.loadSap();
      let externalScript = document.createElement('script')
      externalScript.setAttribute('src', '../dateAndNumber.js')
      document.head.appendChild(externalScript)
  }
};
</script>
