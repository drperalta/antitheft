<template>
    <div >
        <v-toolbar flat class="toolbar" height="56px">
             <!-- PAGE TITLE -->
            <v-toolbar-title class="title">PICTURES</v-toolbar-title>
            <v-spacer></v-spacer>

        </v-toolbar>
        <v-divider class="divider"></v-divider>
        <v-container pa-0>
            <div class="scroll-y" id="scrolling-techniques" style="max-height: 79vh;">
                <v-container class="container" justify-center >
                    <v-expansion-panel flat>
                        <v-expansion-panel-content v-for="folder in imageFolder" :key="folder.folder_name">
                                <div slot="header">{{ folder.folder_name }}</div>
                                <v-card>
                                    <v-container grid-list-sm fluid>
                                         <v-layout row wrap>
                                            <v-flex v-for="image in imageData" v-if="image.folder_name == folder.folder_name" :key="image.id" xs4 d-flex>
                                                <v-card flat tile>
                                                    <img :src="'api/storage/'+image.user_id+'/'+image.serial_number+'/'+folder.folder_name+'/'+image.file_name" class="image" width="100%" height="100%">
                                                </v-card>
                                            </v-flex>
                                        </v-layout>  
                                    </v-container>
                                </v-card>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-container>
            </div>
        </v-container>
        
    </div>
</template>

<script>
import store from '../../../../store/store'
import { mapGetters } from 'vuex'

let interval;

export default {
    data(){
        return{
        }
    },
    methods:{
    },
    created(){
        this.$root.pageTitle = 'PICTURES'
        Vue.picture.getFolder()
        Vue.picture.getFile()
        
    },
    mounted(){
        // interval = setInterval(() => {
        //         store.dispatch('SET_IMAGEDATA',store.getters.selectedKit)
        //     }, 1000)
    },
    beforeDestroy(){
        clearInterval(interval)
    },
    computed:{
        ...mapGetters([
            'imageData',
            'imageFolder',
        ])
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
