<template lang="html">
    <div class="cont">
        <p class="singin">SIGN IN</p>
        <el-alert class="notification" type="error" v-if="error">{{errorMsg}}</el-alert>
        <el-form class="form">
            <!-- Email and Password -->
            <el-input class="el-input" v-model="LoginDetails.email" placeholder="Email" />
            <el-input class="el-input" v-model="LoginDetails.password" placeholder="Password" :type="'password'" />
            <div class="div-rememberMe">
                <el-checkbox class="rememberMe" v-model="LoginDetails.remember_me">Remember Me</el-checkbox>
            </div>
            <!-- Forgotten Password -->
            <div class="resetpassword">
                <router-link to="/reset-password">
                    <a class="forgotPassword">Forgotten your password?</a>
                </router-link>
            </div><br>
            <!-- Register Link  -->
            <div class="formBottom">
                <router-link to="/register">
                    <a class="needAccount">Need and account? Sign Up</a>
                </router-link>
                <!-- Login Button -->
                <el-button class="loginButton" plain color="#00afec" type="submit" @click.prevent="login">Sign In</el-button>
            </div>
        </el-form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                LoginDetails: {
                    email: '',
                    password: '',
                    remember_me: false
                },
                success: false,
                error: false,
                errorMsg: null
            }
        },
        methods: {
            login() {
                alert('Haha!');
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
.notification{
    margin-bottom: 8px;
    background-color: rgba(255, 0, 0, 0.3);
    color: whitesmoke;
}
.el-input {
    padding: 4px;
}

.singin {
    color: #428ccb;
    margin-bottom: 20px;
}

.resetpassword {
    float: right;
    padding: 4px;
}

.forgotPassword {
    font-size: 13px;
}

.needAccount {
    margin-right: 15px;
    font-size: 15px
}

.formBottom {
    margin-top: 40px;
    float: right;
    padding: 4px;
}

.loginButton {
    width: 110px;
    color: white;
    background-color: transparent;
}

.rememberMe {
    font-weight: 400;
    color: white;
}

.div-rememberMe {
    padding: 4px;
    float: left;
    margin: 0;
}
</style>
