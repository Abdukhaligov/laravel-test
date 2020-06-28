<template>
  <div>
    <a href="#" class="nav-item nav-link"
       v-b-modal.modal-user-details
       @click="getUserDetails(getCookie('token'))"
    >Details</a>
    <b-modal id="modal-user-details" title="Details" hide-footer>
      <div class="row">
        <div class="col-12">
          <p class="font-weight-normal"><strong>ID: </strong> {{userDetails.id}}</p>
          <p class="font-weight-normal"><strong>Name: </strong> {{userDetails.name}}</p>
          <p class="font-weight-normal"><strong>Email: </strong> {{userDetails.email}}</p>
          <p class="font-weight-normal"><strong>Company: </strong> {{userDetails.company}}
          <p class="font-weight-normal"><strong>Position: </strong> {{userDetails.position}}
          </p>
          <p class="font-weight-normal"><strong>Created: </strong> {{userDetails.created_at}}</p>
          <p class="font-weight-normal"><strong>Updated: </strong> {{userDetails.updated_at}}</p>
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
  import {mapActions, mapState} from "vuex";
  import {getCookie, removeCookie} from "tiny-cookie";

  export default {
    name: "Details",
    computed: mapState(["userDetails"]),
    methods: {
      ...mapActions(['getUserDetails']),
      getCookie,
    },
    mounted() {
      this.getUserDetails();
    }
  }
</script>

<style scoped>

</style>