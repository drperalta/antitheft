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
import 'element-ui/lib/theme-chalk/display.css'
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'
import VueProgressBar from 'vue-progressbar'
import VeeValidate from 'vee-validate'

import Auth from '../js/api/auth'
import Reset from '../js/api/reset'
import Kit from '../js/api/kit'
import Picture from '../js/api/picture'

Vue.use(Vuetify)
Vue.use(ElementUI)
locale.use(lang)
Vue.use(VueProgressBar)
Vue.use(VeeValidate);

Vue.use(Auth);
Vue.use(Reset);
Vue.use(Kit);
Vue.use(Picture);


window.axios=axios

router.beforeEach(
    (to,from,next) => {
        router.app.$Progress.start()

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
        else if(to.matched.some(record => record.meta.forAdmin)){
            if(Vue.auth.isAdmin()){
                next({
                    path: '/user'
                })
            }else next()
        }

        else next()
    }
)

router.afterEach(() => {
    router.app.$Progress.finish()
})

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
