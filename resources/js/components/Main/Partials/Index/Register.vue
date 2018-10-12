<template lang="html">
    <div class="cont">
        <p class="signup">SIGN UP</p>

        <el-alert class="notification" id="error" type="error" v-if="error">{{errorMsg}}</el-alert>
        <el-alert class="notification" id="success" type="success" v-if="success">Successfully Created!</el-alert>
        <el-form class="form" :model="registerDetails">

            <el-input class="el-input" v-model="RegisterDetails.fullname" placeholder="Full Name"></el-input>
            <el-input class="el-input" v-model="RegisterDetails.username" placeholder="Username"></el-input>
            <el-input class="el-input" v-model="RegisterDetails.email" placeholder="Email"></el-input>
            <el-input class="el-input" v-model="RegisterDetails.password" placeholder="Password" :type="'password'"></el-input>
            <el-input class="el-input" v-model="RegisterDetails.confirm_password" placeholder="Confirm Password" :type="'password'"></el-input>

            <div class="formBottom">
                <router-link to="/login">
                    <a class="alreadyMember">Already a member? Sign In</a>
                </router-link>
                <el-button class="registerButton" plain color="#00afec" type="submit" @click.prevent="register">Sign Up</el-button>
            </div>
        </el-form>
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
        errorMsg: null
        }
    },
    methods:{
        register(){
            this.error = false;
            this.success = false;
            this.errorMsg = null;

            Vue.auth.register(this, this.RegisterDetails);
        }
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
    margin-right: 15px;
    font-size: 15px
}

.formBottom {
    margin-top: 40px;
    float: right;
}

.registerButton {
    width: 130px;
    color: white;
    background-color: transparent;
}
</style>
