<template>
  <form>
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
  </form>
</template>

<script>
  import {mapState} from "vuex";

  export default {
    name: "Details",
    computed: mapState(["userDetails"]),
  }
</script>

<style scoped>

</style>