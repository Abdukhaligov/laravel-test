<template>

</template>

<script>
  import {mapActions, mapState} from "vuex";
  import {getCookie} from "tiny-cookie";

  export default {
    name: "Media",
    data() {
      return {
        files: '',
        token: getCookie('token')
      }
    },
    computed: mapState(["media","loading"]),
    methods: {
      ...mapActions([]),
      submitFiles(token) {
        let formData = new FormData();

        for( var i = 0; i < this.files.length; i++ ){
          let file = this.files[i];

          formData.append('files[' + i + ']', file);
        }


        this.insertMedia({'token': token, data: formData}, true);
      },

    },
    mounted() {
    },
  }
</script>

<style scoped>

</style>