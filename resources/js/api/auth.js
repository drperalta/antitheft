import router from '../router/router'
import store from '../store/store'

export default function(Vue){
    Vue.auth = {
        register(context,data){

            axios.post( 'api/auth/register', data)
            .then(response => {
                context.$root.$emit('register:success')

                context.successMsg = "Successfully Created!"
                context.success = true;

                console.log(response);
                this.clearInput(data);
            }).catch(error => {
                context.$root.$emit('register:error')

                context.success = false;
                this.handleError('REGISTER',context, error);
            })

        },
        check(context, token){
            axios.get('/api/auth/signup/check/'+token)
            .then(response => {
                console.log(response)
            }).catch(error => {
                this.handleError('CHECK', context, error)
            })
        },
        confirm(context, token){
            axios.get('/api/auth/signup/confirm/'+token)
            .then(response => {
                context.success = true
                context.hide = true
                context.successMsg = response.data.message

                console.log(response)
            }).catch(error => {
                console.log(error)
            })
        },
        login(context,data){

            axios.post('api/auth/login', data)
            .then(response => {
                context.$root.$emit('login:success')

                this.setToken(response.data.access_token, response.data.expires_at)
                router.push({ path: 'overview' })
            }).catch(error => {
                context.$root.$emit('login:error')

                this.handleError('LOGIN',context, error);
            })

        },

        logout(){
            axios.get('api/auth/logout', {
                headers: { 'Authorization': 'Bearer ' + this.getToken() }
            }).then(response => {
                this.destroyToken();
                router.push({ path: 'login' })
            })
        },

        user(){
            if(this.isAuthenticated){
                axios.get('api/auth/user', {
                    headers: { 'Authorization': 'Bearer ' + this.getToken() }
                }).then(response => {
                    store.commit('SET_USERDATA', response.data)
                    store.dispatch('SET_KITDATA')
                })
            }
            return Vue.auth
        },

        // addKit(context,data){
        //     axios.post(
        //         'api/kit',data).then(response =>{
        //             if(response.status == 200){
        //                 context.response = response.data.message
        //                 console.log(response.data.message)
        //             }
        //         }), response => {
        //             context.response = response.data
        //             context.error = true
        //         }
        // },
        // getKit(data){

        //     if(this.isAuthenticated){
        //         axios.get('api/auth/user', {
        //             headers: { 'Authorization': 'Bearer ' + this.getToken() }
        //         }).then(response => {
        //             data.id = response.data.id;
        //             data.fullname = response.data.fullname;
        //             data.username = response.data.username;
        //             data.email = response.data.email;
        //             console.log(response);
        //         })
        //     }
        //     return Vue.auth
        // },

        clearInput(data){
            data.fullname = ''
            data.username = ''
            data.email = ''
            data.password = ''
            data.confirm_password = ''
        },
        handleError(type,context,error){
            if(type == 'LOGIN'){
                context.error = true;
                var errorArray = Object.values(error.response.data.errors);

                context.errorMsg = errorArray[0][0];
            }
            else if(type == 'REGISTER'){
                context.error = true;
                var errorArray = Object.values(error.response.data.errors);
                //context.errorMsg = errorArray[0][0];

                if(error.response.data.errors.password[0] === "The password format is invalid."){
                    context.errorMsg = "The password should have at least one uppercase letter, one lowercase letter, and one number"
                }else {
                    context.errorMsg = errorArray[0][0];
                }
            }
            else if(type ==  'CHECK'){
                context.error = true;
                context.hide = true;
                var errorArray = Object.values(error.response.data.errors);

                context.errorMsg = errorArray[0][0];
            }
        },

        //TOKEN HANDLING/////////////
        setToken(token, expiration){
            localStorage.setItem('token', token)
            localStorage.setItem('expiration', expiration)
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

        destroyToken(){
            localStorage.removeItem('token')
            localStorage.removeItem('expiration')

        },

        isAuthenticated(){
            if(this.getToken())
                return true;
            else
                return false;
        },

        setConfirmationEmail(token){
            axios.get('/api/auth/setEmail/'+token)
            .then(response => {
                store.commit('SET_EMAIL', response.data['email'])
            })
        },
    }

    Object.defineProperties(Vue.prototype, {
        $auth:{
            get(){
                return Vue.auth;
            }
        }
    })
}
