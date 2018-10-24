import router from '../router/router'
import store from '../store/store'

export default function(Vue){
    Vue.picture = {
        get(){
            store.dispatch('SET_IMAGEDATA')
        }
    }
}
