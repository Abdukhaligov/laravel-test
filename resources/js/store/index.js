import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex, axios);

export default new Vuex.Store({
  state: {
    products: [],
    users: [],
    media: [],
    credential: [],
    userDetails: [],
    companies: [],
    positions: [],
    errors: {},
    loading: false,
    url: 'http://test/api/'
  },
  actions: {
    getProfileMedia({commit, state}, token) {
      let config = {headers: {Authorization: `Bearer ${token}`}};

      axios
        .get(state.url + "profile-media", config)
        .then(r => commit('GET_MEDIA', r.data));
    },
    setProducts({commit, state}) {
      axios
        .post(state.url + "products")
        .then(r => commit('SET_PRODUCTS', r.data));
    },
    getCompanies({commit, state}) {
      axios
        .post(state.url + "companies")
        .then(r => commit('GET_COMPANIES', r.data));
    },
    getUsers({commit, state}, token) {
      let config = {headers: {Authorization: `Bearer ${token}`}};

      axios
        .get(state.url + "users/list", config)
        .then(r => commit('GET_USERS', r.data));
    },
    getPositions({commit, state}) {
      axios
        .post(state.url + "positions")
        .then(r => commit('GET_POSITIONS', r.data));
    },
    getCredential({commit, state}, data) {
      axios
        .post(state.url + "login?email=" + data[0] + "&password=" + data[1])
        .then(r => commit('SET_CREDENTIAL', r.data));
    },
    setNewUser({commit, state}, data, loading = true) {
      commit('SET_LOADING', true)

      axios
        .post(state.url + "register?" +
          "&name=" + data[0] +
          "&email=" + data[1] +
          "&password=" + data[2] +
          "&password_confirmation=" + data[3] +
          "&company_id=" + data[4] +
          "&position_id=" + data[5])
        .then(r => {
          commit('SET_CREDENTIAL', r.data)
          commit('SET_ERRORS', "")
          commit('SET_LOADING', false)
        })
        .catch(r => {
          commit('SET_ERRORS', r.response.data.errors)
          commit('SET_LOADING', false)
        });
    },
    removeCredential({commit}) {
      commit('DELETE_CREDENTIAL');
    },
    getUserDetails({commit, state}, token) {
      let config = {headers: {Authorization: `Bearer ${token}`}};
      axios
        .post(state.url + "details", '', config)
        .then(r => commit('SET_USER_DETAILS', r.data));
    },
    async setNewProduct({commit, state}, args) {
      let config = {headers: {Authorization: `Bearer ${args.token}`}};

      await axios.post(state.url + "products/create", args.product, config);

      axios.post(state.url + "products").then(r => commit('SET_PRODUCTS', r.data))
    },
    async deleteProduct({commit, state}, args) {
      let config = {headers: {Authorization: `Bearer ${args.token}`}};

      await axios.put(state.url + "products/delete/" + args.id, '', config);

      axios.post(state.url + "products").then(r => commit('SET_PRODUCTS', r.data))

    },
    async editProduct({commit, state}, args) {

      let config = {headers: {Authorization: `Bearer ${args.token}`}};

      await axios.put(state.url + "products/update", args.data, config);

      axios.post(state.url + "products").then(r => commit('SET_PRODUCTS', r.data))
    },
    updateUser({commit, state}, args) {
      let config = {headers: {Authorization: `Bearer ${args.token}`}};

      axios.put(state.url + "profile/update", args.data, config)
        .catch(r => {
          commit('SET_ERRORS', r.response.data.errors)
        });

      axios
        .post(state.url + "details", '', config)
        .then(r => commit('SET_USER_DETAILS', r.data));
    }
  },
  mutations: {
    SET_LOADING(state, loading) {
      state.loading = loading;
    },
    GET_MEDIA(state, media) {
      state.media = media;
    },
    SET_PRODUCTS(state, products) {
      state.products = products;
    },
    GET_USERS(state, users) {
      state.users = users;
    },
    GET_COMPANIES(state, companies) {
      state.companies = companies;
    },
    GET_POSITIONS(state, positions) {
      state.positions = positions;
    },
    SET_CREDENTIAL(state, credential) {
      state.credential = credential;
    },
    SET_ERRORS(state, errors) {
      state.errors = errors;
    },
    DELETE_CREDENTIAL(state) {
      state.credential = "";
    },
    SET_USER_DETAILS(state, userDetails) {
      state.userDetails = userDetails;
    }
  }
})