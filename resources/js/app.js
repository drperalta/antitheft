window.Vue = require('vue');

import Vue from 'vue'
import axios from 'axios'
import router from './router/router'
import store from './store/store'

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import 'element-ui/lib/theme-chalk/reset.css'
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'


import Auth from '../js/api/auth'

Vue.use(Vuetify)
Vue.use(ElementUI)
locale.use(lang)
Vue.use(Auth);

window.axios=axios

router.beforeEach(
    (to,from,next) => {
        if(to.matched.some(record => record.meta.forVisitors)){
            if(Vue.auth.isAuthenticated()){
                next({
                    path: '/overview'
                })
            }else next()
        }
        else if(to.matched.some(record => record.meta.forAuth)){
            if(!Vue.auth.isAuthenticated()){
                next({
                    path: '/login'
                })
            }else next()
        }

        else next()
    }
)

let App = require('./components/Main/App.vue')

const app = new Vue({
    el: '#app',
    components: {App},
    router,store,
    data(){
        return{
            pageTitle:''
        }
    }
});
