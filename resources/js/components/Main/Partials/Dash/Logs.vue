<template>
  <v-container class="container" justify-center>
    LOGS
  </v-container>
</template>

<script>
import store from '../../../../store/store'

export default {
  created(){
    this.$root.pageTitle = 'LOGS'
  }
}
</script>

<style scoped>
.container{
    height: 100%;
}
</style>
