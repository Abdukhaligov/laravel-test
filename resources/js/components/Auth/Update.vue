<template>
  <div>
    <a href="#" class="nav-item nav-link"
       v-b-modal.modal-user-update
       @click="getUserDetails(getCookie('token'))"
    >Update Profile</a>
  </div>

</template>


<script>
  import {mapActions, mapState} from "vuex";
  import {getCookie} from "tiny-cookie";

  export default {
    name: "Update",
    computed: mapState([, "loading", "companies", "positions", "userDetails"]),
    data() {
      return {
        user: {
          name: "",
          company_id: "",
          position_id: "",
        }
      }
    },
    methods: {
      ...mapActions(['setNewUser', 'getCompanies', 'getPositions', 'updateUser', 'getUserDetails']),
      update(data) {
        this.updateUser({'token': getCookie('token'), data: data});
      },
      getCookie,
    },
    mounted() {
      this.getCompanies();
      this.getPositions();
    },
    watch: {
      errors: function () {
        console.log(this.errors);
      },
      loading: function () {
        console.log(this.loading);
      }
    }
  }
</script>
