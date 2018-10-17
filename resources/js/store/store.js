import Vue from 'vue'
import Vuex from 'vuex'
import router from '../router/router'

Vue.use(Vuex)

export default new Vuex.Store({

    state:{
        userData: [],
        userEmail: [],

    },

    getters:{
        //
    },

    mutations:{
        SET_USERDATA: (state, data) => {
            state.userData.push(data)
        },
        SET_EMAIL: (state, data) => {
            state.userEmail.push(data)
        }
    },

    actions:{
        //
    }


})
