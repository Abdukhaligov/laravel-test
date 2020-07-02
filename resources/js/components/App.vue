<template>
  <div id="app">
    <Login v-if="loginForm" :login-form="loginForm" @updateLoginForm="updateLoginForm"></Login>
    <Register v-if="!loginForm" :login-form="loginForm" @updateLoginForm="updateLoginForm"></Register>
  </div>
</template>

<script>

  import 'bootstrap/dist/css/bootstrap.min.css'
  import 'bootstrap/dist/js/bootstrap.min'
  import 'bootstrap-vue/dist/bootstrap-vue.css';
  import Login from "./Auth2/Login";
  import Register from "./Auth2/Register";


export default {
    name: 'App',
    data(){
      return{
        loginForm: true,
      }
    },
    methods: {
      updateLoginForm(loginForm) {
        this.loginForm = loginForm
      }
    },
    components: {
      Login,
      Register,
    }
  }
</script>

<style>

</style>
