<template>
  <div id="app">

    <BlockUI v-if="loading"></BlockUI>

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

  import 'bootstrap/dist/js/bootstrap.min'
  import 'bootstrap-vue/dist/bootstrap-vue.css';

  import '../../libs/cork/plugins/apex/apexcharts.css';
  import '../../libs/cork/plugins/animate/animate.css';

  import '../../libs/cork/assets/css/plugins.css';
  import '../../libs/cork/assets/css/authentication/form-2.css';
  import '../../libs/cork/assets/css/forms/theme-checkbox-radio.css';
  import '../../libs/cork/assets/css/forms/switches.css';
  import '../../libs/cork/assets/css/plugins.css';
  import '../../libs/cork/assets/css/dashboard/dash_1.css';
  import '../../libs/cork/assets/css/scrollspyNav.css';
  import '../../libs/cork/assets/css/components/cards/card.css';
  import '../../libs/cork/assets/css/components/custom-modal.css';
  import '../../libs/cork/assets/css/users/user-profile.css';


  import Login from "./Auth/Login";
  import Register from "./Auth/Register";
  import Dashboard from "./Dashboard/Main";
  import BlockUI from "./BlockUI";

  export default {
    name: 'App',
    components: {
      Login,
      Register,
      Dashboard,
      BlockUI
    },
    data() {
      return {
        loginForm: true,
        token: getCookie('token')
      }
    },
    computed: mapState(["credential", "loading"]),
    methods: {
      ...mapActions(['setCredential', 'getCompanies', 'getPositions', 'getUser', 'getUserMedia','getUsers']),
      getCookie,
      updateLoginForm(loginForm) {
        this.loginForm = loginForm
      }
    },
    mounted() {
      this.getCompanies();
      this.getPositions();
      if (this.token){
        this.getUser(this.token);
        this.getUserMedia(this.token);
        this.getUsers(this.token);
      }
    },
    watch: {
      credential: function () {
        if (this.credential.status === "success") {
          setCookie('token', this.credential.token);
          this.getUser(this.credential.token);
          this.getUserMedia(this.credential.token);
          this.getUsers(this.credential.token);
        } else {
          removeCookie('token');
        }
      }
    }
  }
</script>

<style>
  .invalid {
    color: #e7515a;
  }
</style>
