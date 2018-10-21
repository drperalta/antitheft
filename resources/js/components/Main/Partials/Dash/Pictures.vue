<template>
  <v-container class="container" justify-center>
    PICTURES
  </v-container>
</template>

<script>
import store from '../../../../store/store'

export default {
  created(){
    this.$root.pageTitle = 'PICTURES'
  }
}
</script>

<style scoped>
.container{
    height: 100%;
}
</style>
