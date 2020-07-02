<template>
  <div class="form-main">
    <div class="form-container outer">
      <div class="form-form">
        <div class="form-form-wrap">
          <div class="form-container">
            <div class="form-content">
              <h1 class="">Sign In</h1>
              <p class="">Log in to your account to continue.</p>
              <div class="text-left">
                <form class="form" @submit.prevent>
                  <div id="username-field" class="field-wrapper input">
                    <label for="email">Email</label>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-user">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <input id="email" v-model="email" name="email" type="text" class="form-control" placeholder="e.g mail@domain.com">
                  </div>
                  <div id="password-field" class="field-wrapper input mb-2">
                    <div class="d-flex justify-content-between">
                      <label for="password">PASSWORD</label>
                      <a class="forgot-pass-link">Forgot Password?</a>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-lock">
                      <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                      <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input id="password" v-model="password" name="password" :type="showPassword ? 'text' : 'password'" class="form-control" placeholder="Password">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         @click="showPassword ? showPassword = false : showPassword = true"
                         v-model="showPassword" class="feather feather-eye">
                      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                      <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                  </div>
                  <div class="d-sm-flex justify-content-between">
                    <div class="field-wrapper">
                      <button @click="login" type="submit" class="btn btn-primary" value="">Log In</button>
                    </div>
                  </div>
                  <p class="signup-link">Not registered ? <a href="#" @click="updateLoginForm(false)">Create an account</a></p>
                </form>

                <div class="invalid" v-if="credential.status === 'error'">
                  <hr>
                  <strong>{{credential.message}}</strong>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {mapActions, mapState} from "vuex";

  export default {
    name: "Login",
    props: ['loginForm'],
    data(){
      return {
        email: '',
        password: '',
        showPassword: false
      }
    },
    methods: {
      updateLoginForm: function (loginForm) {
        this.$emit('updateLoginForm', loginForm);
      },
      ...mapActions(['getCredential', 'removeCredential', 'getUserDetails']),
      login() {
        this.getCredential([this.email, this.password]);
      }
    },
    computed: mapState(["credential"]),
    watch: {
      credential: function () {
        if (this.credential.status === "success") {
          this.$refs['modal-login'].hide();
        }
      }
    }
  }
</script>

<style scoped>
  .form-main{
    overflow: auto;
    margin: 0;
    padding: 0;
    background-color: #0e1726;
  }
</style>