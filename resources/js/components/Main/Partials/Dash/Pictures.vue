<template>
    <div >
        <v-toolbar flat class="toolbar" height="56px">
             <!-- PAGE TITLE -->
            <v-toolbar-title class="title">PICTURES</v-toolbar-title>
            <v-spacer></v-spacer>

        </v-toolbar>
        <v-divider class="divider"></v-divider>
        <v-container pa-0>
            <!-- <div class="scroll-y" id="scrolling-techniques" style="max-height: 79vh;">
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
            </div> -->

            <!-- <v-layout row wrap>
                <v-flex v-for="image in imageData" :key="image.id" xs4>
                <img :src="this.storage_path+imageData.user_id+'/'+imageData.serial_number+'/'+imageData.folder_name+'/'+imageData.file_name" class="image" width="100%" height="100%">
                </v-flex>
            </v-layout> -->

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
            storage_path: '../../../../../../storage/app/1/000000001417758e/2018-10-25 09-01-03.409486/1.jpg'
        }
    },
    methods:{
    },
    created(){
        this.$root.pageTitle = 'PICTURES'
        Vue.picture.get()
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
            'selectedKit'
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
