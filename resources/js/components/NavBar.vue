<template>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">

        <a
          href="#"
          class="nav-item nav-link"
          v-b-modal.modal-1
          v-if="credential.status !== 'ok' && !getCookie('token')">Login</a>

        <b-modal ref="modal-1" id="modal-1" title="Login" hide-footer>

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
              @click="login">Login</button>

          </form>
          <div>{{credential.status}}</div>

        </b-modal>

        <a href="#" class="nav-item nav-link"
           v-b-modal.modal-2 v-show="credential.status === 'ok' || getCookie('token')"
           @click="getUserDetails(getCookie('token'))"
        >Details</a>
        <b-modal id="modal-2" title="Details" hide-footer>

          <form>

            <div class="row">
              <div class="col-12" v-if="credential">
                <p class="font-weight-normal"><strong>ID: </strong> {{userDetails.id}}</p>
                <p class="font-weight-normal"><strong>Name: </strong> {{userDetails.name}}</p>
                <p class="font-weight-normal"><strong>Email: </strong> {{userDetails.email}}</p>
                <p class="font-weight-normal"><strong>Email verification: </strong> {{userDetails.email_verified_at}}</p>
                <p class="font-weight-normal"><strong>Created: </strong> {{userDetails.created_at}}</p>
                <p class="font-weight-normal"><strong>Updated: </strong> {{userDetails.updated_at}}</p>
              </div>

            </div>
          </form>


        </b-modal>



        <a href="#" class="nav-item nav-link" v-show="credential.status === 'ok' || getCookie('token')" @click="logout">Logout</a>


      </div>
    </div>
  </nav>
</template>

<script>

  import {mapState, mapActions} from 'vuex'
  import {setCookie, getCookie, removeCookie} from 'tiny-cookie'


  export default {
    name: "NavBar",
    data(){
      return {
        email: 'admin@a.a',
        password: '123123',
      }
    },
    computed: mapState(["credential","userDetails"]),
    methods: {
      ...mapActions(['getCredential','removeCredential','getUserDetails']),
      login() {
        this.getCredential([this.email,this.password]);
      },
      getCookie,
      logout(){
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
        if(this.credential.status === "ok"){
          this.$refs['modal-1'].hide();
          setCookie('token', this.credential.token);
        }else{
          removeCookie('token');
        }
      }
    }
  }
</script>

<style scoped>

</style>