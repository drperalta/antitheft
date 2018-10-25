import router from '../router/router'
import store from '../store/store'

export default function(Vue){
    Vue.picture = {
        getFile(){
            
            store.dispatch('SET_IMAGEDATA')
        },
        getFolder(){
            store.dispatch('SET_IMAGEFOLDER')
        }
    }
}
