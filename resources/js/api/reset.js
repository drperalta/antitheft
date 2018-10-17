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
            axios.post('/api/password/reset', data)
            .then(response => {
                context.success = true
                context.successMsg = response.data.message
                context.showForm = false;

                this.handleSuccess(context, response)
            }).catch(error => {
                this.handleError('RESET', context, error)
            })
        },

        handleError(type, context, error){

            if(type == 'CREATE'){
                context.error = true;
                var errorArray = Object.values(error.response.data.errors);

                context.errorMsg = errorArray[0][0];
            }
            else if(type == 'RESET'){
                context.error = true;
                var errorArray = Object.values(error.response.data.errors);

                if(error.response.data.errors.password[0] === "The password format is invalid."){
                    context.errorMsg = "The password should have at least one uppercase letter, one lowercase letter, and one number"
                }else {
                    context.errorMsg = errorArray[0][0];
                }
            }
            else if(type == 'CHECK'){
                context.error = true;
                context.invalid = true;
                context.showForm = false;
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
        setEmail(token){
            axios.get('/api/password/setEmail/'+token)
            .then(response => {
                store.commit('SET_EMAIL', response.data['email'])
            })
        },
        
        check(context, token){
            axios.get('/api/password/check/'+token)
            .then(response => {
                console.log(response)
            }).catch(error => {
                this.handleError('CHECK', context, error)
            })
        }
    }
}
