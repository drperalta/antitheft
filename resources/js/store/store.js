import Vue from 'vue'
import Vuex from 'vuex'
import router from '../router/router'

Vue.use(Vuex)

export default new Vuex.Store({

    state:{
        userData: []
    },

    getters:{
        //
    },

    mutations:{
        SET_USERDATA: (state, data) => {
            state.userData.push(data)
        },


    },

    actions:{
        //
    }


})