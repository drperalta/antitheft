import router from '../router/router'
import store from '../store/store'

export default function(Vue){
    Vue.reset = {
        create(context, data){
            axios.post('/api/password/create', data)
            .then(response => {
                this.handleSuccess(context, response)
                this.clearInput(data)
            }).catch(error =>{
                this.handleError('CREATE', context, error)
            })
        },
        find(){

        },
        reset(context,data){

        },

        handleError(type, context, error){

            if(type == 'CREATE'){
                context.error = true;
                var errorArray = Object.values(error.response.data.errors);

                context.errorMsg = errorArray[0][0];
            }

        },
        handleSuccess(context, response){
            context.success = true;
            context.successMsg = response.data.message;
        },
        clearInput(data){
            data.email = ''
        },
    }
}
