<template>
    <div>
        <v-toolbar flat class="toolbar" height="56px">
             <!-- PAGE TITLE -->
            <v-toolbar-title class="title">KITS</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn flat @click="dialog = true;">ADD</v-btn>
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
    data(){
        return{
            kitDetails:{
                user_id: '',
                name: '',
                serial_number:''
            },
            error: false,
            success: true,
            errorMsg: null,
            successMsg: null,
        }
    },
    method:{
        add(){
            this.error = false;
            this.success = false;
            this.errorMsg = null;
            this.successMsg = null;

            Vue.kit.add(this,this.kitDetails);
        },
    },
    created(){
        this.$root.pageTitle = 'KITS'
        
    },
    computed:{
        //
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
