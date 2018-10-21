<template>
  <v-container class="container" justify-center>
    OVERVIEW
  </v-container>
</template>

<script>
import store from '../../../../store/store'

export default {
  created(){
    this.$root.pageTitle = 'OVERVIEW'
  }
}
</script>

<style scoped>
.container{
    height: 100%;
}
</style>
