<template lang="html">
    <div class="cont">
        <p class="singin">SIGN IN</p>
        <el-alert class="notification" type="error" v-if="error" :title="errorMsg" :closable="false" center/>
        <v-form class="form" @submit.prevent="login">
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
            </div>
            <!-- Register Link  -->
            <div class="formBottom">
                <!-- Login Button -->
                <v-btn outline class="loginButton" type="submit" :loading="isLoading">Sign In</v-btn>
                <!-- REGISTRATION LINK -->
                <router-link to="/register">
                    <a >Need and account? Sign Up</a>
                </router-link>
            </div>
        </v-form>
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
    color: #00afec;
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
    font-size: 15px;
    margin-top: 10px;
}

.formBottom {
    margin-top: 50px;
    padding: 4px;
}

.loginButton {
    width: 100%;
    color: #00afec;
    background-color: transparent;
    margin: 0;
    margin-bottom: 10px;
    padding: 4px;
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
