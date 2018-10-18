<template lang="html">
    <div class="cont">
        <p class="changepassword">CHANGE PASSWORD</p>
        <el-alert id="error" class="notification" type="error" v-if="error" :closable="false" center>{{errorMsg}}</el-alert>
        <el-alert id="success" class="notification" type="success" v-if="success" :closable="false" center>{{successMsg}}</el-alert>
        <v-form class="form" v-if="showForm" @submit.prevent="changePassword">
            <!-- New Password and Confirm Password -->
            <el-input class="el-input" v-model="ChangePassDetails.password" placeholder="New Password" :type="'password'" :disabled="isLoading" />
            <el-input class="el-input" v-model="ChangePassDetails.confirm_password" placeholder="Confirm Password" :type="'password'" :disabled="isLoading" />

            <div class="formBottom">
                <!-- Change Password Button -->
                <v-btn outline class="changePassButton" type="submit" :loading="isLoading">Change Password</v-btn>
            </div>
        </v-form>
        <router-link to="/login" v-if="invalid">
            <v-btn outline class="backToLogin" type="submit">Back to Login</v-btn>
        </router-link>
        <router-link to="/login" v-if="success">
            <v-btn outline class="backToLogin" type="submit">Back to Login</v-btn>
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
                showForm: true,
                isLoading: false
            }
        },
        methods: {
            changePassword(){
                this.ChangePassDetails.email = this.userEmail[0];
                this.success = false;
                this.error = false;
                this.errorMsg = null;
                this.successMsg = null;

                this.isLoading = true

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
        },
        mounted() {
            this.$root.$on('change:success', () => {
                this.isLoading = false
            })

            this.$root.$on('change:error', () => {
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
    color: #00afec;
    background-color: transparent;
    margin: 0;
    margin-bottom: 10px;
    padding: 4px;
}

.backToLogin {
    width: 100%;
    color: #00afec;
    background-color: transparent;
    margin: 0;
    margin-bottom: 10px;
    padding: 4px;
}
</style>
