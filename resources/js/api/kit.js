import router from '../router/router'
import store from '../store/store'

export default function(Vue){
    Vue.kit = {
        add(context, data){
            axios.post('api/user/kit/add', {
                user_id: store.getters.userID,
                name: data.name,
                serial_number: data.serial_number
            }, 
            { headers: { 'Authorization': 'Bearer ' + this.getToken() } })
            .then(response => {

                context.addNotif.success = true;
                context.addNotif.successMsg = response.data.message

                store.dispatch('SET_KITDATA')

            }).catch(error => {
                this.handleError('ADD', context, error)
            })
        },
        edit(context, name, serial, id){
            axios.post('api/user/kit/edit', {
              user_id: store.getters.userID,
              id: id,
              name: name,
              serial_number: serial
            },{ headers: { 'Authorization': 'Bearer ' + this.getToken() } })
            .then(response =>{
                context.editNotif.success = true;
                context.editNotif.successMsg = response.data.message

                store.dispatch('SET_KITDATA')

            }).catch(error => {
                handleError('EDIT', context, error)
            })
         },
        remove(id){
            axios.post('api/user/kit/remove', {kitId: id},
            { headers: { 'Authorization': 'Bearer ' + this.getToken() } })
            .then(response => {
                store.dispatch('SET_KITDATA')
            })
        },
        handleError(type,context,error){
            if(type === 'ADD'){
                context.addNotif.error = true;
                var errorArray = Object.values(error.response.data.errors);

                context.addNotif.errorMsg = errorArray[0][0];
            }
            else if(type === 'EDIT'){
                context.editNotif.error = true;
                var errorArray = Object.values(error.response.data.errors);

                context.editNotif.errorMsg = errorArray[0][0];
            }
        },
        clearInput(type,data){
            if(type === 'ADD'){
                data.name = '',
                data.serial_number = ''
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

        }
    }
}
