<template lang="html">
    <div class="cont">
        <p class="resetpassword">RESET PASSWORD</p>
        <el-alert class="notification" type="error" v-if="error">{{errorMsg}}</el-alert>
        <el-form class="form">
            <!-- Email -->
            <el-input class="el-input" v-model="ResetPassDetails.email" placeholder="Email" />
            <!-- Register Link  -->
            <div class="formBottom">
                <router-link to="/login">
                    <a class="backToLogin">Nevermind, I got it.</a>
                </router-link>
                <!-- Send Email Button -->
                <el-button class="sendButton" plain color="#00afec" type="submit" @click.prevent="sendEmail">Send Email</el-button>
            </div>
        </el-form>
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
                errorMsg: null
            }
        },
        methods: {
            sendEmail() {
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

.resetpassword {
    color: #428ccb;
    margin-bottom: 20px;
}

.formBottom {
    margin-top: 20px;
    float: right;
}

.sendButton {
    margin-left: 15px;
    width: 130px;
    color: white;
    background-color: transparent;
}
</style>
