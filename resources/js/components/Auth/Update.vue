<template>
  <div>
    <div v-if="loading" class="text-center">LOADING</div>
    <form v-if="!loading">
      <div class="form-group">
        <label for="registerName">Name</label>
        <input type="text"
               class="form-control"
               id="registerName"
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
        <label for="registerCompany">Company</label>
        <select class="form-control" name="company" v-model="user.company_id = userDetails.company_id"
                id="registerCompany">
          <option selected value="">Select company</option>
          <option v-for="company in companies" :value="company.id">
            {{ company.name }}
          </option>
        </select>
      </div>
      <div class="form-group">
        <label for="registerPosition">Position</label>
        <select class="form-control" name="company" v-model="user.position_id = userDetails.position_id"
                id="registerPosition">
          <option selected value="">Select position</option>
          <option v-for="position in positions" :value="position.id">
            {{ position.name }}
          </option>
        </select>
      </div>
      <button
          type="submit"
          class="btn btn-primary"
          @click="update(user)">
        Update
      </button>
    </form>
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
          email: "",
          company_id: "",
          position_id: "",
        }
      }
    },
    methods: {
      ...mapActions(['setNewUser', 'getCompanies', 'getPositions', 'updateUser']),
      update(data) {
        this.updateUser({'token': getCookie('token'), data: data});
      },
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
