<template>
    <div>
        <v-toolbar flat class="toolbar" height="56px">
             <!-- PAGE TITLE -->
            <v-toolbar-title class="title">LOGS</v-toolbar-title>
            <v-spacer></v-spacer>

        </v-toolbar>
        <v-divider class="divider"></v-divider>
        <v-container class="container" justify-center>

        </v-container>
    </div>
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
.toolbar{
}
.title{
  font-weight: 600;
  color: rgb(68, 68, 68);
}
.divider{
    margin: 0;
}
</style>
