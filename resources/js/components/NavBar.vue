<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a
            href="#"
            class="nav-item nav-link"
            v-b-modal.modal-login
            v-if="credential.status !== 'ok' && !getCookie('token')">Login</a>
        <b-modal ref="modal-login" id="modal-login" title="Login" hide-footer>
          <Login></Login>
        </b-modal>
        <a
            href="#"
            class="nav-item nav-link"
            v-b-modal.modal-registration
            v-if="credential.status !== 'ok' && !getCookie('token')">Registration</a>
        <b-modal ref="modal-registration" id="modal-registration" title="Registration" hide-footer>
          <Registration></Registration>
        </b-modal>
        <a href="#" class="nav-item nav-link"
           v-b-modal.modal-user-update v-show="credential.status === 'ok' || getCookie('token')"
           @click="getUserDetails(getCookie('token'))"
        >Update Profile</a>
        <b-modal id="modal-user-update" title="Update profile" hide-footer>
          <UpdateProfile v-if="credential"></UpdateProfile>
        </b-modal>
        <a href="#" class="nav-item nav-link"
           v-b-modal.modal-user-details v-show="credential.status === 'ok' || getCookie('token')"
           @click="getUserDetails(getCookie('token'))"
        >Details</a>
        <b-modal id="modal-user-details" title="Details" hide-footer>
          <Details v-if="credential"></Details>
        </b-modal>
        <a href="#" class="nav-item nav-link" v-show="credential.status === 'ok' || getCookie('token')" @click="logout">Logout</a>
      </div>
    </div>
  </nav>
</template>

<script>
  import {mapState, mapActions} from 'vuex'
  import {setCookie, getCookie, removeCookie} from 'tiny-cookie'
  import Login from './Auth/Login';
  import Registration from './Auth/Registration';
  import Details from './Auth/Details';
  import UpdateProfile from "./Auth/UpdateProfile";

  export default {
    name: "NavBar",
    computed: mapState(["credential"]),
    components: {
      Login,
      Registration,
      Details,
      UpdateProfile
    },
    methods: {
      ...mapActions(['getCredential', 'removeCredential', 'getUserDetails']),
      getCookie,
      logout() {
        this.$bvModal.msgBoxConfirm('Are you sure you want to logout ?')
          .then(value => {
            if (value === true) {
              removeCookie('token');
              this.removeCredential();
            }
          });
      }
    },
    watch: {
      credential: function () {
        if (this.credential.status === "ok") {
          this.$refs['modal-login'].hide();
          this.$refs['modal-registration'].hide();
          setCookie('token', this.credential.token);
        } else {
          removeCookie('token');
        }
      }
    }
  }
</script>
