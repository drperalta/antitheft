import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import PageNotFound from '../components/PageNotFound.vue'

import Index from '../components/Main/Pages/Index.vue'
import Dash from '../components/Main/Pages/Dash.vue'

import Login from '../components/Main/Partials/Index/Login.vue'
import Register from '../components/Main/Partials/Index/Register.vue'
import ResetPassword from '../components/Main/Partials/Index/ResetPassword'
import ChangePassword from '../components/Main/Partials/Index/ChangePassword'

import ConfirmEmail from '../components/Main/Partials/Index/ConfirmEmail'

import Overview from '../components/Main/Partials/Dash/Overview.vue'
import Kits from '../components/Main/Partials/Dash/Kits.vue'
import Pictures from '../components/Main/Partials/Dash/Pictures.vue'
import Logs from '../components/Main/Partials/Dash/Logs.vue'

let router = new Router({

    mode: 'history',

    routes: [
        {
            // INDEX ROUTES
            path: '/', name: 'index', component: Index, redirect: {path: 'login'},
            children: [
                {
                    path: 'login',
                    component: Login,
                    meta: {forVisitors: true}
                },
                {
                    path: 'register',
                    component: Register,
                    meta: {forVisitors: true}
                },
                {
                    path: 'reset-password',
                    component: ResetPassword,
                    meta: {forVisitors: true}
                },
                {
                    path: 'change-password/:token',
                    component: ChangePassword,
                    meta: {forVisitors: true}
                },
                {
                    path: 'confirm-email/:activation_token',
                    component: ConfirmEmail,
                    meta: {forVisitors: true}
                }
            ]
        },
        // DASH ROUTES
        {
            path: '/', name: 'overview', component: Dash, meta: {forAuth: true},
            children: [
                {
                    path: 'overview',
                    component: Overview,
                    meta: {forAuth: true}
                },
                {
                    path: 'pictures',
                    component: Pictures,
                    meta: {forAuth: true}
                },
                {
                    path: 'logs',
                    component: Logs,
                    meta: {forAuth: true}
                },
            ]
        },
        {
            path: '/kits',
            component: Kits,
            meta: {forAuth: true}
        },
        {
            path: '*',
            component: PageNotFound
        }
    ]
})


export default router
