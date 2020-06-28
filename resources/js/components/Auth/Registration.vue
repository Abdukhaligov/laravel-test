<template>
  <div>
    <div v-if="loading" class="text-center">LOADING</div>
    <form v-if="!loading">
      <div class="form-group">
        <label for="registerName">Name</label>
        <input type="text"
               class="form-control"
               id="registerName"
               v-model="name"
               placeholder="Enter name">
        <div v-if="errors.name">
          <strong>{{ errors.name[0] }}</strong>
        </div>
      </div>
      <div class="form-group">
        <label for="registerEmail">Email address</label>
        <input type="email"
               class="form-control"
               id="registerEmail"
               v-model="email"
               aria-describedby="emailHelp"
               placeholder="Enter email">
        <div v-if="errors.email">
          <strong>{{ errors.email[0] }}</strong>
        </div>
      </div>
      <div class="form-group">
        <label for="registerPassword">Password</label>
        <input
            type="password"
            class="form-control"
            id="registerPassword"
            v-model="password"
            placeholder="Password">
        <div v-if="errors.password">
          <strong>{{ errors.password[0] }}</strong>
        </div>
      </div>
      <div class="form-group">
        <label for="registerPasswordConfirmation">Confirm Password</label>
        <input
            type="password"
            class="form-control"
            id="registerPasswordConfirmation"
            v-model="password_confirmation"
            placeholder="Confirm Password">
      </div>
      <div class="form-group">
        <label for="registerCompany">Company</label>
        <select class="form-control" name="company" v-model="company_id" id="registerCompany">
          <option selected value="">Select company</option>
          <option v-for="company in companies" :value="company.id">
            {{ company.name }}
          </option>
        </select>
      </div>
      <div class="form-group">
        <label for="registerPosition">Position</label>
        <select class="form-control" name="company" v-model="position_id" id="registerPosition">
          <option selected value="">Select position</option>
          <option v-for="position in positions" :value="position.id">
            {{ position.name }}
          </option>
        </select>
      </div>
      <button
          type="submit"
          class="btn btn-primary"
          @click="registration">
        Sign Up
      </button>
    </form>
  </div>
</template>

<script>
  import {mapActions, mapState} from "vuex";

  export default {
    name: "Registration",
    computed: mapState(["errors", "loading", "companies", "positions"]),
    data() {
      return {
        name: 'asd',
        email: 'asd@asd.asd',
        password: '456456',
        password_confirmation: '456456',
        company_id: '2',
        position_id: '3',
      }
    },
    methods: {
      ...mapActions(['setNewUser', 'getCompanies', 'getPositions']),
      registration() {
        this.setNewUser([
          this.name,
          this.email,
          this.password,
          this.password_confirmation,
          this.company_id,
          this.position_id]);
      }
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