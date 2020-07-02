<template>
  <div>
    <Loader></Loader>
    <NavBar></NavBar>
  </div>
</template>

<script>
  import NavBar from "./NavBar";
  import Loader from "./Loader";

  export default {
    name: "Main",
    components:{
      NavBar,
      Loader
    }
  }
</script>

<style scoped>

</style>