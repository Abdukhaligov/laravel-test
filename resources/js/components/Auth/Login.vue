<template>
  <div>
    <a href="#" class="nav-item nav-link" v-b-modal.modal-login>Login</a>
    <b-modal ref="modal-login" id="modal-login" title="Login" hide-footer>
      <div>
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
        <div v-if="credential.status === 'error'">
          <hr>
          <strong>{{credential.message}}</strong>
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
  import {mapActions, mapState} from "vuex";

  export default {
    name: "Login",
    data() {
      return {
        email: '',
        password: '',
      }
    },
    computed: mapState(["credential"]),
    methods: {
      ...mapActions(['getCredential', 'removeCredential', 'getUserDetails']),
      login() {
        this.getCredential([this.email, this.password]);
      }
    },
    watch: {
      credential: function () {
        if (this.credential.status === "ok") {
          this.$refs['modal-login'].hide();
        }
      }
    }
  }
</script>
