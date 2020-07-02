<template>
  <div>
    <Loader></Loader>
    <NavBar></NavBar>
    <Container></Container>
  </div>
</template>

<script>
  import NavBar from "./NavBar";
  import Loader from "./Loader";
  import Container from "./Container";

  export default {
    name: "Main",
    components: {
      NavBar,
      Loader,
      Container
    }
  }
</script>
