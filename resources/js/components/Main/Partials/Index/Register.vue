<template lang="html">
    <div class="cont">
        <p class="signup">SIGN UP</p>
        <!-- Alerts  -->
        <el-alert class="notification" id="error" type="error" v-if="error" :closable="false" center>{{errorMsg}}</el-alert>
        <el-alert class="notification" id="success" type="success" v-if="success" :closable="false" center>{{successMsg}}</el-alert>
        <v-form class="form" @submit.prevent="register">
            <!-- Inputs  -->
            <el-input class="el-input" v-model="RegisterDetails.fullname" placeholder="Full Name" :disabled="isLoading"></el-input>
            <el-input class="el-input" v-model="RegisterDetails.username" placeholder="Username" :disabled="isLoading"></el-input>
            <el-input class="el-input" v-model="RegisterDetails.email" placeholder="Email" :disabled="isLoading"></el-input>
            <el-input class="el-input" v-model="RegisterDetails.password" placeholder="Password" :type="'password'" :disabled="isLoading"></el-input>
            <el-input class="el-input" v-model="RegisterDetails.confirm_password" placeholder="Confirm Password" :type="'password'" :disabled="isLoading"></el-input>

            <div class="formBottom">
                <!-- Sign Up Button  -->
                <v-btn outline class="registerButton" type="submit" :loading="isLoading">Sign Up</v-btn>
                <!-- Back to Login -->
                <router-link to="/login">
                    <a class="alreadyMember">Already a member? Sign In</a>
                </router-link>

            </div>
        </v-form>
    </div>
</template>

<script>
export default {
    data(){
        return{
        RegisterDetails:{
            fullname: '',
            username:'',
            email: '',
            password: '',
            confirm_password: ''
        },
        error: false,
        success: false,
        errorMsg: null,
        successMsg: null,
        isLoading: false
        }
    },
    methods:{
        register(){
            this.error = false;
            this.success = false;
            this.errorMsg = null;

            this.isLoading = true

            Vue.auth.register(this, this.RegisterDetails);
        }
    },

    mounted() {
        this.$root.$on('register:success', () => {
            this.isLoading = false
        })

        this.$root.$on('register:error', () => {
            this.isLoading = false
        })
    }
}
</script>

<style scoped>
a {
    text-decoration: none;
    color: white;
    opacity: 0.8;
}
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
.el-input {
    padding: 4px;
}

.signup {
    color: #428ccb;
    margin-bottom: 20px;
}

.alreadyMember {
    font-size: 15px
}

.formBottom {
    margin-top: 25px;
    padding: 4px;
}

.registerButton {
    width: 100%;
    color: #00afec;
    background-color: transparent;
    margin: 0;
    margin-bottom: 10px;
    padding: 4px;
}
</style>
