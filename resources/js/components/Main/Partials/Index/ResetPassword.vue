<template lang="html">
    <div class="cont">
        <p class="resetpassword">RESET PASSWORD</p>
        <el-alert id="error" class="notification" type="error" v-if="error" :closable="false" center>{{errorMsg}}</el-alert>
        <el-alert id="success" class="notification" type="success" v-if="success" :closable="false" center>{{successMsg}}</el-alert>
        <v-form class="form" @submit.prevent="sendEmail">
            <!-- Email -->
            <el-input class="el-input" v-model="ResetPassDetails.email" placeholder="Email" :disabled="isLoading" />
            <!-- Register Link  -->
            <div class="formBottom">
                <!-- Send Email Button -->
                <v-btn outline class="sendButton"type="submit" :loading="isLoading">Send Email</v-btn>
                <!-- Back to login Link-->
                <router-link to="/login">
                    <a class="backToLogin">Nevermind, I got it.</a>
                </router-link>
            </div>
        </v-form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ResetPassDetails: {
                    email: ''
                },

                success: false,
                error: false,
                errorMsg: null,
                successMsg: null,
                isLoading: false
            }
        },
        methods: {
            sendEmail() {
                this.success = false;
                this.error = false;
                this.errorMsg = null;
                this.successMsg = null;

                this.isLoading = true

                Vue.reset.create(this, this.ResetPassDetails)
            }
        },

        mounted() {
            this.$root.$on('reset:success', () => {
                this.isLoading = false
            })

            this.$root.$on('reset:error', () => {
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
.el-input{
    padding: 4px;
}

.resetpassword {
    color: #428ccb;
    margin-bottom: 20px;
}

.formBottom {
    margin-top: 15px;
    padding: 4px;
}

.sendButton {
    width: 100%;
    color: #00afec;
    background-color: transparent;
    margin: 0;
    margin-bottom: 10px;
    padding: 4px;
}
</style>
