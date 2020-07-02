<template>
  <div>
    <a href="#" class="nav-item nav-link" v-b-modal.modal-media>My Media</a>
    <b-modal ref="modal-media" id="modal-media" size="lg" title="My Media" hide-footer>
      <div v-if="loading" class="text-center">LOADING</div>
      <div v-if="!loading">
        <div v-if="media.status === 'empty'">
        {{ media.message }}
      </div>
        <div v-if="media.status === 'success'">
          <div v-for="file in media.files">
            <a :href="file.path" target="_blank">{{ file.name }}</a>
          </div>
        </div>
        <hr>
        <input type="file" v-on:change="handleFilesUpload()" ref="files" multiple="multiple">
        <button
            type="submit"
            class="btn btn-primary"
            @click="submitFiles(token)">
          Upload
        </button>
      </div>
    </b-modal>
  </div>
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
      ...mapActions(['getUserMedia', 'insertMedia']),
      submitFiles(token) {
        let formData = new FormData();

        for( var i = 0; i < this.files.length; i++ ){
          let file = this.files[i];

          formData.append('files[' + i + ']', file);
        }


        this.insertMedia({'token': token, data: formData}, true);
      },
      handleFilesUpload() {
        this.files = this.$refs.files.files;
      },
    },
    mounted() {
      this.getUserMedia(this.token);
    },
  }
</script>

<style scoped>

</style>