<template lang="html">
    <div class="cont">
        <p class="singin">SIGN IN</p>
        <el-alert class="notification" type="error" v-if="error" :title="errorMsg" :closable="false" center/>
        <el-form class="form" @submit.native.prevent="login">
            <!-- Username and Password -->
            <el-input class="el-input" v-model="LoginDetails.username" placeholder="Username" :disabled="isLoading" />
            <el-input class="el-input" v-model="LoginDetails.password" placeholder="Password" type="password" :disabled="isLoading" />
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
                <el-button class="loginButton" plain color="#00afec" native-type="submit" :loading="isLoading">Sign In</el-button>
            </div>
        </el-form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                LoginDetails: {
                    username: '',
                    password: '',
                    remember_me: false
                },
                success: false,
                error: false,
                errorMsg: null,
                isLoading: false
            }
        },
        methods: {
            login() {
                this.error = false;
                this.success = false;
                this.errorMsg = null;

                this.isLoading = true

                Vue.auth.login(this, this.LoginDetails);
            }
        },
        mounted () {
            this.$root.$on('login:success', () => {
                this.isLoading = false
            })

            this.$root.$on('login:error', () => {
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
