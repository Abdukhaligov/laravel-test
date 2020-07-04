<template>
  <div class="form form-main">
    <div class="form-container outer">
      <div class="form-form">
        <div class="form-form-wrap">
          <div class="form-container">
            <div class="form-content">

              <h1 class="">Register</h1>
              <p class="signup-link register">
                Already have an account? <a href="#" @click="updateLoginForm(true)">Log in</a>
              </p>
              <form class="text-left" @submit.prevent>
                <div class="form">

                  <div id="username-field" class="field-wrapper input">
                    <label for="username">USERNAME</label>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-user">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <input
                        id="username"
                        v-model="name"
                        type="text"
                        class="form-control"
                        placeholder="Username">
                    <div class="invalid" v-if="errors.name">
                      <strong>{{ errors.name[0] }}</strong>
                    </div>
                  </div>

                  <div id="email-field" class="field-wrapper input">
                    <label for="email">EMAIL</label>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-at-sign register">
                      <circle cx="12" cy="12" r="4"></circle>
                      <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
                    </svg>
                    <input
                        id="email"
                        v-model="email"
                        type="text"
                        class="form-control"
                        placeholder="Email">
                    <div class="invalid" v-if="errors.email">
                      <strong>{{ errors.email[0] }}</strong>
                    </div>
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
                    <input id="password" :type="showPassword ? 'text' : 'password'"
                           v-model="password"
                           class="form-control" placeholder="Password">
                    <div class="invalid" v-if="errors.password">
                      <strong>{{ errors.password[0] }}</strong>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         @click="showPassword ? showPassword = false : showPassword = true"
                         v-model="showPassword"
                         class="feather feather-eye">
                      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                      <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                  </div>

                  <div class="field-wrapper input mb-2">
                    <div class="d-flex justify-content-between">
                      <label for="password-confirmation">CONFIRM PASSWORD</label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-lock">
                      <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                      <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input id="password-confirmation" :type="showPassword ? 'text' : 'password'"
                           v-model="password_confirmation"
                           class="form-control" placeholder="Confirm password">
                  </div>


                  <div class="field-wrapper">
                    <div class="d-flex justify-content-between">
                      <label for="company">COMPANY</label>
                    </div>
                  </div>
                  <vue-select v-model="company_id"
                              id="company"
                              class="form-control basic"
                              :options="companies"
                              :reduce="company => company.id" label="name"></vue-select>

                  <div class="field-wrapper">
                    <div class="d-flex justify-content-between">
                      <label for="position">POSITION</label>
                    </div>
                  </div>
                  <vue-select v-model="position_id"
                              id="position"
                              class="form-control basic"
                              :options="positions"
                              :reduce="position => position.id" label="name"></vue-select>


                  <div class="field-wrapper terms_condition">
                    <div class="n-chk">
                      <label class="new-control new-checkbox checkbox-primary">
                        <input type="checkbox" class="new-control-input">
                        <span class="new-control-indicator"></span><span>I agree to the <a href="javascript:void(0);">  terms and conditions </a></span>
                      </label>
                    </div>

                  </div>

                  <div class="d-sm-flex justify-content-between">
                    <div class="field-wrapper">
                      <button type="submit" class="btn btn-primary" @click="registration">Get Started!</button>
                    </div>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {mapActions, mapState} from "vuex";
  import Vue from 'vue'
  import 'vue-select/dist/vue-select.css';


  import vSelect from 'vue-select'

  Vue.component('vue-select', vSelect)

  export default {
    name: "Login",
    props: ['loginForm'],
    data() {
      return {
        showPassword: false,
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        company_id: '',
        position_id: '',
        result1: '',
      }

    },
    computed: mapState(["errors", "companies", "positions"]),
    methods: {
      ...mapActions(['setNewUser']),
      updateLoginForm: function (loginForm) {
        this.$emit('updateLoginForm', loginForm);
      },
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
    watch: {
      credential: function () {
        if (this.credential.status === "success") {
          this.$refs['modal-registration'].hide();
        }
      },
      company_id: function () {
        if (this.company_id === null){
          this.company_id = "";
        }
      },
      position_id: function () {
        if (this.position_id === null){
          this.position_id = "";
        }
      }
    },
  }
</script>

<style>
  .form-main {
    overflow: auto;
    margin: 0;
    padding: 0;
    background-color: #0e1726;
  }

  .basic {
    margin-bottom: 15px;
    padding: 0;
  }

  .vs__search {
    color: #009688;
    font-weight: 600;
    font-size: 16px;
  }

  .vs__search::placeholder,
  .vs__dropdown-toggle,
  .vs__dropdown-menu {
    font-weight: 600;
    font-size: 16px;
    max-height: 150px;
    background: #1b2e4b;
    border: 1px solid #1b2e4b;
    text-transform: lowercase;
    font-variant: small-caps;
  }

  .vs__selected {
    color: white;
    font-weight: 600;
    font-size: 16px;
    background-color: #254f90;
  }

  .vs__selected-options {
    color: white;
    font-weight: 600;
    font-size: 16px;
    height: 38px;
  }

  .vs__dropdown-option {
    color: white;
    font-weight: 600;
    font-size: 16px;
  }

  .vs__clear,
  .vs__open-indicator {
    fill: #394066;
  }

</style>
