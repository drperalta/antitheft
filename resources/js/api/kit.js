import router from '../router/router'
import store from '../store/store'

export default function(Vue){
    Vue.kit = {
        add(context, data){
            axios.post('api/kit/add', data)
            .then(response => {

            }).catch(error => {

            })
        }
    }

}
