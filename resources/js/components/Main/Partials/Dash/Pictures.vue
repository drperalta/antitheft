<template>
    <div >
        <v-toolbar flat class="toolbar" height="56px">
             <!-- PAGE TITLE -->
            <v-toolbar-title class="title">PICTURES</v-toolbar-title>
            <v-spacer></v-spacer>

        </v-toolbar>
        <v-divider class="divider"></v-divider>
        <div class="scroll-y" id="scrolling-techniques" style="max-height: 79vh;">
            <v-container class="container" justify-center >
            <v-expansion-panel flat>
                <v-expansion-panel-content v-for="(item,i) in 20" :key="i">
                <div slot="header">Item</div>
                <v-card>
                    <v-card-text>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</v-card-text>
                </v-card>
                </v-expansion-panel-content>
            </v-expansion-panel>
            
        </v-container>
        </div>
        
    </div>
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
