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
        imageFolder: [],
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
        imageFolder: (state) => {
            return state.imageFolder
        },
        imageData: (state) => {
            return state.imageData
        },
        selectedKit: (state) => {
            return state.selectedKit
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
        SET_IMAGEFOLDER: (state) => {
            axios.get('api/event/get/folder/'+state.userData.id+'/'+state.selectedKit)
            .then(response => {
                state.imageFolder = response.data
            })
        },
        SET_IMAGEDATA: (state) => {
            axios.get('api/event/get/file/'+state.userData.id+'/'+state.selectedKit)
            .then(response => {
                state.imageData = response.data
            })
        },
        SET_SELECTEDKIT: (state, serial) =>{
            state.selectedKit = serial
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
        },
        SET_SELECTEDKIT({commit},serial){
            commit('SET_SELECTEDKIT',serial)
            
        },
        SET_IMAGEFOLDER({commit}){
            commit('SET_IMAGEFOLDER')
        }
    }


})
