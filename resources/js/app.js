import Vue from 'vue'
import store from './store'
import App from './components/App.vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueCookie from 'vue-cookie'

Vue.use(BootstrapVue, IconsPlugin, VueCookie);

Vue.config.productionTip = false;

new Vue({
    store:store,
    render: h => h(App),
}).$mount('#app');
