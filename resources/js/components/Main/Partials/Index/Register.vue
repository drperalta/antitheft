<template lang="html">
    <div class="cont">
        <p class="signup">SIGN UP</p>

        <el-alert class="notification" type="error" v-if="error">{{errorMsg}}</el-alert>
        <el-alert class="notification" type="success" v-if="success">Successfully Created!</el-alert>
        <el-form class="form" :model="registerDetails">

            <el-input class="el-input" v-model="registerDetails.fullname" placeholder="Full Name"></el-input>
            <el-input class="el-input" v-model="registerDetails.username" placeholder="Username"></el-input>
            <el-input class="el-input" v-model="registerDetails.email" placeholder="Email"></el-input>
            <el-input class="el-input" v-model="registerDetails.password" placeholder="Password" :type="'password'"></el-input>
            <el-input class="el-input" v-model="registerDetails.confirm_password" placeholder="Confirm Password" :type="'password'"></el-input>

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
        registerDetails:{
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

.el-input {
    margin: 4px;
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
