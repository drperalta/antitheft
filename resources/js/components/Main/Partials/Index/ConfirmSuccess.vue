<template>
    <div class="cont">
        <p class="successconfirm">CONFIRMATION SUCCESS</p>
        <p class="email">{{this.email}}</p>
        <!-- Send Email Button -->
        <router-link to="/login">
            <el-button class="backToLogin" plain color="#00afec" type="submit">Back to Login</el-button>
        </router-link>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                email: ''
            }
        }
    }
</script>

<style scoped>
.successconfirm {
    color: #428ccb;
    margin-bottom: 20px;
}

.backToLogin {
    width: 100%;
    color: white;
    background-color: transparent;
    margin-bottom: 10px;
}
</style>