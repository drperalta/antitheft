window.Vue = require('vue');

import Vue from 'vue'
import router from './router/router'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

Vue.use(Vuetify)
Vue.use(Buefy)

let App = require('./components/Main/App.vue')

const app = new Vue({
    el: '#app',
    components: {App},
    router
});
