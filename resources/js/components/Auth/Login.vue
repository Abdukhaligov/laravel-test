<template>
  <form>
    <div class="form-group">
      <label for="loginEmail">Email address</label>
      <input type="email"
             class="form-control"
             id="loginEmail"
             aria-describedby="emailHelp"
             v-model="email"
             placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="loginPassword">Password</label>
      <input
          type="password"
          class="form-control"
          id="loginPassword"
          v-model="password"
          placeholder="Password">
    </div>
    <button
        type="submit"
        class="btn btn-primary"
        @click="login">Login
    </button>
    <div>{{credential.status}}</div>
  </form>
</template>

<script>
  import {mapActions, mapState} from "vuex";
  import {getCookie, removeCookie, setCookie} from "tiny-cookie";

  export default {
    name: "Login",
    data() {
      return {
        email: 'admin@site.com',
        password: '123456',
      }
    },
    computed: mapState(["credential"]),
    methods: {
      ...mapActions(['getCredential', 'removeCredential', 'getUserDetails']),
      login() {
        this.getCredential([this.email, this.password]);
        console.log("login function");
      },
      getCookie,
    }
  }
</script>
