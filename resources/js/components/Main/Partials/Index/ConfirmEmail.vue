<template>
    <div class="cont">
        <p class="successconfirm">EMAIL CONFIRMATION</p>
        <el-alert id="error" class="notification" type="error" v-if="error" :closable="false" center>{{errorMsg}}</el-alert>
        <el-alert id="success" class="notification" type="success" v-if="success" :closable="false" center>{{successMsg}}</el-alert>
        <!-- Email -->
        <el-card class="card" shadow="never" v-if="!hide" body-style="padding: 0">
            <p class="email" >{{this.userEmail[0]}}</p>
        </el-card>
        <!-- Confirm Email Button -->
        <el-button v-if="!hide" class="confirmEmail" plain color="#00afec" type="submit" @click="confirm">Confirm Email</el-button>
        <router-link to="/login" v-if="success">
            <el-button class="backToLogin" plain color="#00afec" type="submit">Back to Login</el-button>
        </router-link>
        <router-link to="/login" v-if="error">
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
               successMsg: null,
               hide: false
            }
        },
        methods:{
            confirm(){
                Vue.auth.confirm(this, this.$route.params.activation_token)
            }
        },
        created(){
            Vue.auth.check(this, this.$route.params.activation_token)
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
    margin-bottom: 15px;
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
.card{
    height: 40px;
    padding: 6px;
    margin-bottom: 20px;
}
.email{
    font-size: 16px;
    font-weight: 400;
}
</style>
