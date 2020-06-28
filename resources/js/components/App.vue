<template>
  <div id="app">

    <NavBar/>

    <ProductList/>

    <hr>


  </div>
</template>

<script>

  import 'bootstrap/dist/css/bootstrap.min.css'
  import 'bootstrap/dist/js/bootstrap.min'
  import ProductList from "./ProductList.vue";
  import NavBar from "./NavBar.vue";
  import 'bootstrap-vue/dist/bootstrap-vue.css'

  export default {

    name: 'App',
    components: {
      ProductList,
      NavBar
    }
  }
</script>

<style>

</style>
