import Vue from 'vue'
import Vuex from 'vuex'
import router from '../router/router'

Vue.use(Vuex)

export default new Vuex.Store({

    state:{
        userData: [],
        userEmail: [],
        kitData: [],
        editKitData: [],
        imageData: [],
        selectedKit: ''

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
        },

        editKitData: (state) => {
            return state.editKitData
        },

        imageData: (state) => {
            return state.imageData
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
        },
        SET_EDITKITDATA: (state, id) => {
            axios.get('api/user/kit/edit/set/'+ id , { headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') } })
            .then(response => {
                state.editKitData = response.data[0]
            })
        },
        SET_IMAGEDATA: (state) => {
            var id = state.userData.id;
            var serial = state.selectedKit;

            axios.get('api/event/get/'+id+'/'+serial)
            .then(response => {
                state.imageData = response.data
            })
        }
    },

    actions:{
        SET_KITDATA({commit}){
            commit('SET_KITDATA')
        },
        SET_EDITKITDATA({commit}, id){
            commit('SET_EDITKITDATA', id)
        },
        SET_IMAGEDATA({commit}){
            commit('SET_IMAGEDATA')
        }
    }


})
