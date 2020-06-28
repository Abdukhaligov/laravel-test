<template>
  <div>
    <a href="#" class="nav-item nav-link" v-b-modal.modal-media>My Media</a>
    <b-modal ref="modal-media" id="modal-media" size="lg" title="My Media" hide-footer>
      <div v-if="media.status === 'empty'">
        {{ media.message }}
      </div>
      <div v-if="media.status === 'ok'">
        <div v-for="file in media.files">
          <a :href="file.path" target="_blank">{{ file.name }}</a>
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
  import {mapActions, mapState} from "vuex";
  import {getCookie} from "tiny-cookie";

  export default {
    name: "Media",
    computed: mapState(["media"]),
    methods: {
      ...mapActions(['getProfileMedia']),
    },
    mounted() {
      this.getProfileMedia(getCookie('token'));
    },
  }
</script>

<style scoped>

</style>