<template>
    <div class="cont">
        <p class="successconfirm">EMAIL CONFIRMATION</p>
        <el-alert id="error" class="notification" type="error" v-if="error">{{errorMsg}}</el-alert>
        <el-alert id="success" class="notification" type="success" v-if="success">{{successMsg}}</el-alert>
        <p class="email" v-if="!success">{{this.userEmail[0]}}</p>
        <!-- Confirm Email Button -->
        <el-button v-if="!success" class="confirmEmail" plain color="#00afec" type="submit" @click="confirm">Confirm Email</el-button>
        <router-link to="/login" v-if="success">
            <el-button class="backToLogin" plain color="#00afec" type="submit">Back to Login</el-button>
        </router-link>
    </div>
</template>

<script>
import store from '../../../../store/store'
    export default {
        data(){
            return {
               success: false,
               error: false,
               errorMsg: null,
               successMsg: null
            }
        },
        methods:{
            confirm(){
                Vue.auth.confirm(this, this.$route.params.activation_token)
            }
        },
        created(){
            Vue.auth.setConfirmationEmail(this.$route.params.activation_token)
        },
        computed:{
            userEmail(){
                return store.state.userEmail
            }
        }
    }
</script>

<style scoped>
.notification {
    margin-bottom: 8px;
    color: whitesmoke;
}
#error {
    background-color: rgba(255, 0, 0, 0.3);
}
#success {
    background-color: rgba(0, 255, 0, 0.3);
}
.successconfirm {
    color: #428ccb;
    margin-bottom: 20px;
}

.confirmEmail {
    width: 100%;
    color: white;
    background-color: transparent;
    margin-bottom: 10px;
}
.backToLogin{
    width: 100%;
    color: white;
    background-color: transparent;
    margin-bottom: 10px;
}
.email{
    font-size: 16px;
    color: white;
    font-weight: 300;
}
</style>
