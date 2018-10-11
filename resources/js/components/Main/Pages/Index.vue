<template>
    <div class="index">
        <v-container class="vContainer" grid-list-xs>
            <img class="logo" src="../../../img/logo.png">
            <h1 class="title">ANTI-THEFT KIT</h1>
            <router-view></router-view>
        </v-container>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>
.index {
    width: 100vw;
    height: 100vh;
    background: url('../../../img/index-bg.jpg')
}

.logo {
    width: 110px
}

.vContainer {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 380px;
    text-align: center;
}

.title {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: white;
}
</style>
