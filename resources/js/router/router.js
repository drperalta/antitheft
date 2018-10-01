import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import Index from '../components/Main/Pages/Index.vue'
import Dash from '../components/Main/Pages/Dash.vue'

import Login from '../components/Main/Partials/Index/Login.vue'
import Register from '../components/Main/Partials/Index/Register.vue'

import Overview from '../components/Main/Partials/Dash/Overview.vue'
import Kits from '../components/Main/Partials/Dash/Kits.vue'
import Pictures from '../components/Main/Partials/Dash/Pictures.vue'
import Logs from '../components/Main/Partials/Dash/Logs.vue'

let router = new Router({

    mode: 'history',

    routes: [
      {
        // INDEX ROUTES
        path: '/', name: 'index', component: Index,
        children: [
          {
            path: 'login',
            component: Login
          },
          {
            path: 'register',
            component: Register
          }
        ]
      },
      // DASH ROUTES
      {
        path: '/', name: 'overview', component: Dash,
        children: [
          {
            path: 'overview',
            component: Overview
          },
          {
            path: 'kits',
            component: Kits
          },
          {
            path: 'pictures',
            component: Pictures
          },
          {
            path: 'logs',
            component: Logs
          },
        ]
      }
    ]
})

export default router
