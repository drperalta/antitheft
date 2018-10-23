import Vue from 'vue'
import Vuex from 'vuex'
import router from '../router/router'

Vue.use(Vuex)

export default new Vuex.Store({

    state:{
        userData: [],
        userEmail: [],
        kitData: [],

    },

    getters: {
        userData: (state) => {
            return state.userData
        },
        kitData: (state) => {
            return state.kitData
        },
        userEmail: (state) => {
            return state.userEmail
        },
        userID: (state) => {
            return state.userData.id
        }

    },

    mutations:{
        SET_USERDATA: (state, data) => {
            state.userData = data
        },
        SET_EMAIL: (state, data) => {
            state.userEmail.push(data)
        },
        SET_KITDATA: (state) => {
            axios.get('api/user/kit/set/' + state.userData.id, { headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') } })
            .then(response => {
                state.kitData = response.data
            })
        }
    },

    actions:{
        SET_KITDATA({commit}){
            commit('SET_KITDATA')
        }
    }


})
