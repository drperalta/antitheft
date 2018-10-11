<template lang="html">
    <div class="cont">
        <p class="resetpassword">RESET PASSWORD</p>
        <el-alert class="notification" type="error" v-if="error">{{errorMsg}}</el-alert>
        <el-form class="form">
            <!-- Email -->
            <el-input class="el-input" v-model="ResetPassDetails.email" placeholder="Email" />
            <!-- Register Link  -->
            <div class="formBottom">
                <!-- Send Email Button -->
                <el-button class="sendButton" plain color="#00afec" type="submit" @click.prevent="sendEmail">Send Email</el-button>
                <!-- Back to login Link-->
                <router-link to="/login">
                    <a class="backToLogin">Nevermind, I got it.</a>
                </router-link>
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

.el-input{
    padding: 4px;
}

.resetpassword {
    color: #428ccb;
    margin-bottom: 20px;
}

.formBottom {
    margin-top: 10px;
    padding: 4px;
}

.sendButton {
    width: 100%;
    color: white;
    background-color: transparent;
    margin-bottom: 10px;
}
</style>
