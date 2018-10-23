<template>
    <div class="cont">
        <p class="successconfirm">EMAIL CONFIRMATION</p>
        <el-alert id="error" class="notification" type="error" v-if="error" :closable="false" center>{{errorMsg}}</el-alert>
        <el-alert id="success" class="notification" type="success" v-if="success" :closable="false" center>{{successMsg}}</el-alert>
        <!-- Email -->
        <el-card class="card" shadow="never" v-if="!hide" body-style="padding: 0">
            <p class="email" >{{userEmail[0]}}</p>
        </el-card>
        <!-- Confirm Email Button -->
        <v-btn outline v-if="!hide" class="confirmEmail" type="submit" @click="confirm">Confirm Email</v-btn>
        <router-link to="/login" v-if="success">
            <v-btn outline class="backToLogin" type="submit">Back to Login</v-btn>
        </router-link>
        <router-link to="/login" v-if="error">
            <v-btn outline class="backToLogin" type="submit">Back to Login</v-btn>
        </router-link>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
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
        ...mapGetters([
            'userEmail'
        ])
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
    color: #00afec;
    margin-bottom: 20px;
}

.confirmEmail {
    width: 100%;
    color: #00afec;
    background-color: transparent;
    margin: 0;
    margin-bottom: 10px;
    padding: 4px;
}
.backToLogin{
    width: 100%;
    color: #00afec;
    background-color: transparent;
    margin: 0;
    margin-bottom: 10px;
    padding: 4px;
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
