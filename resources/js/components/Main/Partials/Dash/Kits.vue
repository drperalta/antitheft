<template>
    <div>
        <v-toolbar flat class="toolbar" height="56px">
             <!-- PAGE TITLE -->
            <v-toolbar-title class="title">KITS</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn flat>ADD</v-btn>
            </v-toolbar-items>
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
    this.$root.pageTitle = 'KITS'
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
  color: rgb(61, 61, 61);
}
.divider{
    margin: 0;
}
</style>
