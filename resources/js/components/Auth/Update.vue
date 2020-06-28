<template>
  <div>
    <a href="#" class="nav-item nav-link"
       v-b-modal.modal-user-update
       @click="getUserDetails(getCookie('token'))"
    >Update Profile</a>
    <b-modal id="modal-user-update" title="Update profile">
      <div v-if="loading" class="text-center">LOADING</div>
      <div v-if="!loading">
        <div class="form-group">
          <label for="updateName">Name</label>
          <input type="text"
                 class="form-control"
                 id="updateName"
                 v-model="user.name = userDetails.name"
                 placeholder="Enter name">
          <div v-if="errors.name">
            <strong>{{ errors.name[0] }}</strong>
          </div>
        </div>
        <div class="form-group">
          <label>Email address</label>
          <input type="email"
                 disabled
                 :value="userDetails.email"
                 class="form-control">
        </div>
        <div class="form-group">
          <label for="updateCompnay">Company</label>
          <select class="form-control" name="company"
                  v-model="user.company_id = userDetails.company_id"
                  id="updateCompnay">
            <option selected value="">Select company</option>
            <option v-for="company in companies" :value="company.id">
              {{ company.name }}
            </option>
          </select>
        </div>
        <div class="form-group">
          <label for="updatePosition">Position</label>
          <select class="form-control" name="company"
                  v-model="user.position_id = userDetails.position_id"
                  id="updatePosition">
            <option selected value="">Select position</option>
            <option v-for="position in positions" :value="position.id">
              {{ position.name }}
            </option>
          </select>
        </div>

      </div>

      <template v-slot:modal-footer="{close}">
        <button
            type="submit"
            class="btn btn-primary"
            @click="update(user);close()">
          Update
        </button>
      </template>
    </b-modal>
  </div>

</template>


<script>
  import {mapActions, mapState} from "vuex";
  import {getCookie} from "tiny-cookie";

  export default {
    name: "Update",
    computed: mapState(["errors", "loading", "companies", "positions", "userDetails"]),
    data() {
      return {
        user: {
          name: "",
          company_id: "",
          position_id: "",
        }
      }
    },
    methods: {
      ...mapActions(['setNewUser', 'getCompanies', 'getPositions', 'updateUser', 'getUserDetails']),
      update(data) {
        this.updateUser({'token': getCookie('token'), data: data});
      },
      getCookie,
    },
    mounted() {
      this.getCompanies();
      this.getPositions();
    },
    watch: {
      errors: function () {
        console.log(this.errors);
      },
      loading: function () {
        console.log(this.loading);
      }
    }
  }
</script>
