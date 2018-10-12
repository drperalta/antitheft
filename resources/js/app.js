window.Vue = require('vue');

import Vue from 'vue'
import axios from 'axios'
import router from './router/router'

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'

import Auth from '../js/api/auth'

Vue.use(Vuetify)
Vue.use(ElementUI)
locale.use(lang)

Vue.use(Auth);

window.axios=axios

let App = require('./components/Main/App.vue')

const app = new Vue({
    el: '#app',
    components: {App},
    router
});
