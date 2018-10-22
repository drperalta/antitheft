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
        }
    },

    mutations:{
        SET_USERDATA: (state, data) => {
            state.userData.push(data)
        },
        SET_EMAIL: (state, data) => {
            state.userEmail = data
        },
        SET_KITDATA: (state) => {
            axios.get('api/user/kit/set/' + state.userData[0].id, { headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') } })
            .then(response => {
                state.kitData = response.data
            })

        }
    },

    actions:{

    }


})
