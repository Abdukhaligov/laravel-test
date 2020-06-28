<template>
  <form>
    <div class="form-group">
      <label for="registerName">Name</label>
      <input type="text"
             class="form-control"
             id="registerName"
             v-model="name"
             placeholder="Enter name">
    </div>
    <div class="form-group">
      <label for="registerEmail">Email address</label>
      <input type="email"
             class="form-control"
             id="registerEmail"
             v-model="email"
             aria-describedby="emailHelp"
             placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="registerPassword">Password</label>
      <input
          type="password"
          class="form-control"
          id="registerPassword"
          v-model="password"
          placeholder="Password">
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
    <button
        type="submit"
        class="btn btn-primary"
        @click="registration">
      Sign Up
    </button>
  </form>
</template>

<script>
  import {mapActions} from "vuex";

  export default {
    name: "Registration",
    data() {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      }
    },
    methods: {
      ...mapActions(['setNewUser']),
      registration() {
        // this.getCredential([this.email, this.password]);
        this.setNewUser([this.name, this.email, this.password, this.password_confirmation]);
        console.log("Sign up");
      }
    }
  }
</script>
