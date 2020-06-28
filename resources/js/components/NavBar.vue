<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">

        <Login v-if="credential.status !== 'ok' && !getCookie('token')"></Login>

        <Registration v-if="credential.status !== 'ok' && !getCookie('token')"></Registration>

        <Update v-if="credential.status === 'ok' || getCookie('token')"></Update>

        <Details v-if="credential.status === 'ok' || getCookie('token')"></Details>

        <Media v-if="credential.status === 'ok' || getCookie('token')"></Media>

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
  import Update from "./Auth/Update";
  import Media from "./Auth/Media";

  export default {
    name: "NavBar",
    computed: mapState(["credential"]),
    components: {
      Login,
      Registration,
      Details,
      Update,
      Media
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
          setCookie('token', this.credential.token);
        } else {
          removeCookie('token');
        }
      }
    }
  }
</script>
