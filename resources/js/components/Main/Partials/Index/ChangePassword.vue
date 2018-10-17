<template lang="html">
    <div class="cont">
        <p class="changepassword">CHANGE PASSWORD</p>
        <el-alert id="error" class="notification" type="error" v-if="error" :closable="false" center>{{errorMsg}}</el-alert>
        <el-alert id="success" class="notification" type="success" v-if="success" :closable="false" center>{{successMsg}}</el-alert>
        <el-form class="form" v-if="showForm">
            <!-- New Password and Confirm Password -->
            <el-input class="el-input" v-model="ChangePassDetails.password" placeholder="New Password" :type="'password'" />
            <el-input class="el-input" v-model="ChangePassDetails.confirm_password" placeholder="Confirm Password" :type="'password'" />

            <div class="formBottom">
                <!-- Change Password Button -->
                <el-button class="changePassButton" plain color="#00afec" type="submit" @click.prevent="changePassword">Change Password</el-button>
            </div>
        </el-form>
        <router-link to="/login" v-if="invalid">
            <el-button class="backToLogin" plain color="#00afec" type="submit">Back to Login</el-button>
        </router-link>
        <router-link to="/login" v-if="success">
            <el-button class="backToLogin" plain color="#00afec" type="submit">Back to Login</el-button>
        </router-link>
    </div>
</template>

<script>
import store from '../../../../store/store'
    export default {
        data() {
            return {
                ChangePassDetails: {
                    email: '',
                    password: '',
                    confirm_password: '',
                    token: this.$route.params.token
                },

                invalid: false,
                success: false,
                error: false,
                errorMsg: null,
                successMsg: null,
                showForm: true
            }
        },
        methods: {
            changePassword(){
                this.ChangePassDetails.email = this.userEmail[0];
                this.success = false;
                this.error = false;
                this.errorMsg = null;
                this.successMsg = null;

                Vue.reset.reset(this, this.ChangePassDetails)
            }
        },
        created(){
            Vue.reset.check(this, this.$route.params.token)
            Vue.reset.setEmail(this.$route.params.token)

        },
        computed:{
            userEmail(){
                return store.state.userEmail
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

.changepassword {
    color: #428ccb;
    margin-bottom: 20px;
}

.formBottom {
    margin-top: 20px;
    padding: 4px;
}

.changePassButton {
    width: 100%;
    color: white;
    background-color: transparent;
}

.backToLogin {
    width: 100%;
    color: white;
    background-color: transparent;
    margin-bottom: 10px;
}
</style>
