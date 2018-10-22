import router from '../router/router'
import store from '../store/store'

export default function(Vue){
    Vue.kit = {
        add(context, data){
            axios.post('api/user/kit/add', data, { headers: { 'Authorization': 'Bearer ' + this.getToken() } })
            .then(response => {
                context.success = true;
                context.successMsg = response.message;

                console.log(response)

            }).catch(error => {
                this.handleError('ADD', context, error)
            })
        },

        handleError(type,context,error){
            if(type === 'ADD'){
                context.error = true;
                var errorArray = Object.values(error.response.data.errors);

                context.errorMsg = errorArray[0][0];
            }
        },
        clearInput(type,data){
            if(type == 'ADD'){
                //
            }
        },
        getToken(){
            var token = localStorage.getItem('token');
            var expiration = localStorage.getItem('expiration');

            if(!token || !expiration)
                return null;

            if(Date.now('GMT+8') > expiration){
                this.destroyToken();
                return null;
            }else{
                return token;
            }

        },
        computed:{
            userData(){
                return this.$store.state.userData[0]
            }
        },
    }
}
