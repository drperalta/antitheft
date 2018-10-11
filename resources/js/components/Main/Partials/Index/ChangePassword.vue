<template lang="html">
    <div class="cont">
        <p class="changepassword">CHANGE PASSWORD</p>
        <el-alert class="notification" type="error" v-if="error">{{errorMsg}}</el-alert>
        <el-form class="form">
            <!-- New Password and Confirm Password -->
            <el-input class="el-input" v-model="ChangePassDetails.newPassword" placeholder="New Password" :type="'password'" />
            <el-input class="el-input" v-model="ChangePassDetails.confirmPassword" placeholder="Confirm Password" :type="'password'" />
            <div class="formBottom">
                <!-- Change Password Button -->
                <el-button class="changePassButton" plain color="#00afec" type="submit" @click.prevent="changePassword">Change Password</el-button>
            </div>
        </el-form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ChangePassDetails: {
                    newPassword: '',
                    confirmPassword: ''
                },

                success: false,
                error: false,
                errorMsg: null
            }
        },
        methods: {
            changePassword(){
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
</style>
