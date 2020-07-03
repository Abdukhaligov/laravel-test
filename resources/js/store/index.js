import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex, axios);

export default new Vuex.Store({
  state: {
    credential: [],
    user: [],
    media: [],

    users: [],
    products: [],
    companies: [],
    positions: [],
    
    errors: {},
    
    loading: false,
    url: 'http://test/api/',

    page: ['user','profile'],
    sideBar: false
  },
  actions: {
    setPage({commit}, page){
      commit('SET_PAGE', page)
    },
    setSideBar({commit}, sideBar){
      commit('SET_SIDEBAR', sideBar)
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

    setCredential({commit, state}, data, loading = true) {
      commit('SET_LOADING', true)

      axios
        .post(state.url + "login?email=" + data[0] + "&password=" + data[1])
        .then(r => {
          commit('SET_CREDENTIAL', r.data);
          commit('SET_LOADING', false)
        });
    },
    removeCredential({commit}) {
      commit('DELETE_CREDENTIAL');
    },
    
    getUser({commit, state}, token) {
      let config = {headers: {Authorization: `Bearer ${token}`}};
      axios
        .post(state.url + "details", '', config)
        .then(r => commit('SET_USER', r.data));
    },
    async updateUser({commit, state}, args) {
      let config = {headers: {Authorization: `Bearer ${args.token}`}};

      await axios.put(state.url + "profile/update", args.data, config)
        .catch(r => {
          commit('SET_ERRORS', r.response.data.errors)
        });

      axios
        .post(state.url + "details", '', config)
        .then(r => commit('SET_USER', r.data));
    },

    getUserMedia({commit, state}, token) {
      let config = {headers: {Authorization: `Bearer ${token}`}};

      axios
        .get(state.url + "profile-media", config)
        .then(r => commit('GET_MEDIA', r.data));
    },
    insertMedia({commit, state}, args, loading = true) {
      commit('SET_LOADING', true)

      let config = {
        headers: {
          'Content-Type': 'multipart/form-data',
          Authorization: `Bearer ${args.token}`
        }
      };

      axios
        .post(state.url + "profile-media", args.data, config)
        .then(r => {
          commit('GET_MEDIA', r.data);
          commit('SET_LOADING', false)
        })
        .catch(r => {
          commit('SET_ERRORS', r.data)
          commit('SET_LOADING', false)
        });
    },

    getUsers({commit, state}, token) {
      let config = {headers: {Authorization: `Bearer ${token}`}};

      axios
        .get(state.url + "users/list", config)
        .then(r => commit('GET_USERS', r.data));
    },
    getProducts({commit, state}) {
      axios
        .post(state.url + "products")
        .then(r => commit('GET_PRODUCTS', r.data));
    },
    getCompanies({commit, state}) {
      axios
        .post(state.url + "companies")
        .then(r => commit('GET_COMPANIES', r.data));
    },
    getPositions({commit, state}) {
      axios
        .post(state.url + "positions")
        .then(r => commit('GET_POSITIONS', r.data));
    },
    
    async setNewProduct({commit, state}, args, loading = true) {
      commit('SET_LOADING', true)

      let config = {headers: {Authorization: `Bearer ${args.token}`}};

      await axios.post(state.url + "products/create", args.product, config);

      axios
        .post(state.url + "products")
        .then(r => {
          commit('GET_PRODUCTS', r.data);
          commit('SET_LOADING', false)
        })
    },
    async deleteProduct({commit, state}, args) {
      let config = {headers: {Authorization: `Bearer ${args.token}`}};

      await axios.put(state.url + "products/delete/" + args.id, '', config);

      axios.post(state.url + "products").then(r => commit('GET_PRODUCTS', r.data))

    },
    async editProduct({commit, state}, args) {

      let config = {headers: {Authorization: `Bearer ${args.token}`}};

      await axios.put(state.url + "products/update", args.data, config);

      axios.post(state.url + "products").then(r => commit('GET_PRODUCTS', r.data))
    }
  },
  mutations: {
    SET_PAGE(state, page) {
      state.page = page;
    },
    SET_SIDEBAR(state, sideBar) {
      state.sideBar = sideBar;
    },
    SET_LOADING(state, loading) {
      state.loading = loading;
    },
    SET_ERRORS(state, errors) {
      state.errors = errors;
    },
    SET_CREDENTIAL(state, credential) {
      state.credential = credential;
    },
    DELETE_CREDENTIAL(state) {
      state.credential = "";
    },
    SET_USER(state, user) {
      state.user = user;
    },

    GET_MEDIA(state, media) {
      state.media = media;
    },

    GET_USERS(state, users) {
      state.users = users;
    },
    GET_PRODUCTS(state, products) {
      state.products = products;
    },
    GET_COMPANIES(state, companies) {
      state.companies = companies;
    },
    GET_POSITIONS(state, positions) {
      state.positions = positions;
    },
  }
})