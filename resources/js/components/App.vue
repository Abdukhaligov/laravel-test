<template>
  <div id="app">

    <Login v-if="credential.status !== 'ok' && !getCookie('token') && loginForm"
           :login-form="loginForm" @updateLoginForm="updateLoginForm"></Login>

    <Register v-if="credential.status !== 'ok' && !getCookie('token') && !loginForm"
              :login-form="loginForm" @updateLoginForm="updateLoginForm"></Register>

    <Dashboard v-if="credential.status === 'success' || getCookie('token')"></Dashboard>

  </div>
</template>

<script>
  import {mapState, mapActions} from 'vuex'
  import {setCookie, getCookie, removeCookie} from 'tiny-cookie'
  import 'bootstrap/dist/css/bootstrap.min.css'
  import 'bootstrap/dist/js/bootstrap.min'
  import 'bootstrap-vue/dist/bootstrap-vue.css';
  import Login from "./Auth2/Login";
  import Register from "./Auth2/Register";
  import Dashboard from "./Dashboard/Main";

  export default {
    name: 'App',
    components: {
      Login,
      Register,
      Dashboard
    },
    data() {
      return {
        loginForm: true,
      }
    },
    computed: mapState(["credential"]),
    methods: {
      ...mapActions(['getCredential', 'removeCredential', 'getUserDetails']),
      getCookie,

      updateLoginForm(loginForm) {
        this.loginForm = loginForm
      }
    },
    watch: {
      credential: function () {
        if (this.credential.status === "success") {
          setCookie('token', this.credential.token);
        } else {
          removeCookie('token');
        }
      }
    }
  }
</script>

<style>

</style>
