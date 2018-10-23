<template>
    <div>
        <!-- OPEN ADD KIT MODAL -->
        <v-layout row justify-center>
            <v-dialog v-model="openModalAdd" max-width="420">
            <v-card>
                <v-card-title class="headline grey lighten-4">Add Kit</v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <el-alert class="notification" type="error" v-if="error" :title="errorMsg"/>
                        <el-alert class="notification" type="success" v-if="success" :title="successMsg" :closable="false"/>

                        <el-input class="input" placeholder="Name" v-model="kitDetails.name"></el-input>
                        <el-input class="input" placeholder="Serial Number" v-model="kitDetails.serial_number"></el-input>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green darken-1" flat @click.native="openModalAdd = false">Close</v-btn>
                    <v-btn color="green darken-1" flat @click.prevent="add">Add</v-btn>
                </v-card-actions>
                </v-card>
            </v-dialog>
        </v-layout>

        <v-toolbar flat class="toolbar" height="56px">
             <!-- PAGE TITLE -->
            <v-toolbar-title class="title">KITS</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn flat @click="openModalAdd = true; clear()">ADD</v-btn>
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
                name: '',
                serial_number:''
            },
            error: false,
            success: false,
            errorMsg: null,
            successMsg: null,

            openModalAdd: false
        }
    },
    methods:{
        add(){
            this.error = false;
            this.success = false;
            this.errorMsg = null;
            this.successMsg = null;

            Vue.kit.add(this,this.kitDetails);
        },
        clear(){
            
            this.error = false;
            this.success = false;
            this.errorMsg = null;
            this.successMsg = null;
        }
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
.input{
    margin: 5px;
}
.notification{
    margin-bottom: 15px;
}
</style>
