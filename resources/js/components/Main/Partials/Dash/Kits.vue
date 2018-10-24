<template>
    <div>
        <!-- OPEN ADD KIT MODAL -->
        <v-layout row justify-center>
            <v-dialog v-model="openModalAdd" max-width="420">
            <v-card>
                <v-card-title class="headline grey lighten-4">Add Kit</v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <el-alert class="notification" type="error" v-if="addNotif.error" :title="addNotif.errorMsg" :closable="false"/>
                        <el-alert class="notification" type="success" v-if="addNotif.success" :title="addNotif.successMsg" :closable="false"/>

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

        <!-- EDIT KIT MODAL -->
        <v-layout row justify-center>
            <v-dialog v-model="openModalEdit" max-width="420">
            <v-card>
                <v-card-title class="headline grey lighten-4">Edit Kit</v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <el-alert class="notification" type="error" v-if="editNotif.error" :title="editNotif.errorMsg" :closable="false"/>
                        <el-alert class="notification" type="success" v-if="editNotif.success" :title="editNotif.successMsg" :closable="false"/>
                        <el-input class="input" name="name" placeholder="Name" v-model="editKitData.name"></el-input>
                        <el-input class="input" name="serial"  placeholder="Serial Number" v-model="editKitData.serial_number"></el-input>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green darken-1" flat @click.native="openModalEdit = false">Close</v-btn>
                    <v-btn color="green darken-1" flat @click.prevent="edit" :disabled="errors.has('name.serial')">Edit</v-btn>
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
            <v-layout row wrap>
                <div v-for="kit in kitData" :key="kit.name" style="width: 160px; margin: 12px">
                    <v-card >
                        <v-card-actions>
                            <v-icon class="online" v-if="kit.status" size="12px">fiber_manual_record</v-icon>
                            <v-icon class="offline" v-if="!kit.status" size="12px">fiber_manual_record</v-icon>
                            <span class="kitname" v-text="kit.name"></span>
                            <v-spacer></v-spacer>
                            <div>
                                <el-dropdown trigger="click" @command="handleKitCommand">
                                    <span class="el-dropdown-link">
                                        <v-btn icon v-on:click="id(kit.id); set()">
                                            <v-icon>more_vert</v-icon>
                                        </v-btn>
                                    </span>
                                    <el-dropdown-menu slot="dropdown">
                                        <el-dropdown-item command="edit">Edit</el-dropdown-item>
                                        <el-dropdown-item command="remove" >Remove</el-dropdown-item>
                                    </el-dropdown-menu>
                                </el-dropdown>
                            </div>
                        </v-card-actions>
                    </v-card>
                </div>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
import store from '../../../../store/store'
import { mapGetters } from 'vuex'

export default {
    data(){
        return{
            kitDetails:{
                name: '',
                serial_number:''
            },
            kitID: '',

            editNotif:{
                error: false,
                success: false,
                errorMsg: null,
                successMsg: null
            },
            addNotif:{
                error: false,
                success: false,
                errorMsg: null,
                successMsg: null
            },

            openModalAdd: false,
            openModalEdit: false
        }
    },
    methods:{
        add(){
            this.addNotif.error = false;
            this.addNotif.success = false;
            this.addNotif.errorMsg = null;
            this.addNotif.successMsg = null;

            Vue.kit.add(this,this.kitDetails);
        },
        edit(){
            this.editNotif.error = false;
            this.editNotif.success = false;
            this.editNotif.errorMsg = null;
            this.editNotif.successMsg = null;

            Vue.kit.edit(this, store.getters.editKitData.name, store.getters.editKitData.serial_number, this.kitID);
        },
        clear(){

            this.error = false;
            this.success = false;
            this.errorMsg = null;
            this.successMsg = null;
        },
        set(){
            store.dispatch('SET_EDITKITDATA', this.kitID)
        },
        removeWarning() {
            this.$confirm('Do you want to remove your Kit?', 'Warning', {
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel',
            type: 'warning'
            }).then(() => {
            Vue.kit.remove(this.kitID);
            this.$message({
                type: 'success',
                message: 'Delete completed'
            });
            }).catch(() => {
            this.$message({
                type: 'info',
                message: 'Delete canceled'
            });
            });
        },
        id(id){
            this.kitID = id;
        },
        handleKitCommand(command) {
            if(command == 'remove'){
                this.removeWarning();
            }else{
                this.openModalEdit = true;
            }
        }
    },
    created(){
        this.$root.pageTitle = 'KITS'

    },
    computed:{
        ...mapGetters([
            'kitData',
            'editKitData'
        ])
    }
}
</script>

<style scoped>
.container{
    margin: auto;
}
.toolbar{

}
.online{
    color: greenyellow;
    margin-left: 8px
}
.offline{
    margin-left: 8px
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
.kitname{
    margin-left: 5px
}
.validation{
    color: red;
    font-size: 12px;
}
</style>
