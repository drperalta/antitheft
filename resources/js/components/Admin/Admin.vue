<template>
    <v-container class="vContainer" grid-list-xs>
        <router-view></router-view>
    </v-container>
</template>

<script>
export default {
    
}
</script>

<style scoped>
.vContainer {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 500px;
    text-align: center;
}
</style>

