<template>
<div v-loading.fullscreen.lock="logout">
	<el-container class="main-container">
		<!-- SIDEBAR -->
		<el-aside width="256" class="hidden-sm-and-down">
			<el-menu class="sidebar" background-color="#262F3D" text-color="#C0C2C5" active-text-color="#4FC3F7">

				<!-- SIDEBAR TITLE -->

				<div class="side-title">

					<img src="../../../img/logo.png" height="30px">
					<br>
					<h1 class="title">ANTI-THEFT</h1>
					<h2 class="title">KIT</h2>
				</div>

				<v-divider></v-divider>

				<!-- SIDEBAR MENU -->
				<div class="side-menu">
					<!-- OVERVIEW -->
					<!-- <el-menu-item index="overview" @click="overview">
						<v-icon class="icon">dashboard</v-icon>
						<span class="side_title">Overview</span>
					</el-menu-item><v-divider></v-divider> -->
					<!-- PICTURES -->
					<el-menu-item index="pictures" @click="pictures">
						<v-icon class="icon">photo</v-icon>
						<span class="side_title">Pictures</span>
					</el-menu-item><v-divider></v-divider>
					<!-- LOGS -->
					<el-menu-item index="logs" @click="logs">
						<v-icon class="icon">subject</v-icon>
						<span class="side_title">Logs</span>
					</el-menu-item><v-divider></v-divider>
				</div>
			</el-menu>
		</el-aside>

		<el-container>
			<!-- NAVBAR -->
			<el-header class="navbar">
                <v-toolbar class="v-toolbar" flat>
                    <v-btn flat icon style="margin-right: 15px" @click="kits">
                        <v-icon>keyboard_arrow_left</v-icon>
                    </v-btn>
                    <!-- SELECTED KIT -->
                    <!-- <el-select class="select" v-model="value" placeholder="Select your Kit" :change="this.selected()">

                        <el-option v-for="kit in kitData" :key="kit.id" :label="kit.name" :value="kit.serial_number">
                            <v-icon class="online" v-if="kit.status" size="12px">fiber_manual_record</v-icon>
                            <v-icon class="offline" v-if="!kit.status" size="12px">fiber_manual_record</v-icon>
                            <span v-text="kit.name"></span>
                        </el-option>
                    </el-select> -->
                    <v-flex sm1>
                        <span style="margin-right: 1rem;">{{selectedKitData.name}}</span>
                        <el-switch v-model="kitSwitch"
                        active-color="#13ce66"
                        inactive-color="#ff4949" />
                    </v-flex>
                    <v-spacer></v-spacer>
                    <!-- BADGES -->

                    <!-- NAME AND EMAIL -->
                    <div>
                        <h1 class="name">{{userData.fullname}}</h1>
                        <p class="email">{{userData.email}}</p>
                    </div>
                    <v-divider class="divider" vertical></v-divider>
                    <!-- OPTIONS -->
                    <el-dropdown trigger="click" @command="handleCommand">
                        <span>
                            <v-icon>fa-cog</v-icon>
                        </span>
                        <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item v-for="item in items" :key="item.key" :command="item.command">{{item.title}}</el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>
                </v-toolbar>

				<v-divider></v-divider>
			</el-header>

			<!-- MAIN -->
			<el-main class="main" >
				<router-view></router-view>
			</el-main>

			<!-- BOTTOM NAVBAR -->
			<el-footer class="hidden-md-and-up">
				<v-bottom-nav class="navbottom" :value="true" :active.sync="bottomNav" shift color="#262F3D">
                    <!-- <v-btn flat dark @click="overview" value="overview" color="#4FC3F7">
                        <v-icon>dashboard</v-icon>
                    </v-btn> -->

                    <v-btn flat dark @click="pictures" value="pictures" color="#4FC3F7">
                        <v-icon>photo</v-icon>
                    </v-btn>

                    <v-btn flat dark @click="logs" value="logs" color="#4FC3F7">
                        <v-icon>subject</v-icon>
                    </v-btn>
				</v-bottom-nav>
			</el-footer>
		</el-container>
	</el-container>

        <v-dialog v-model="openModalAccount" max-width="420">
            <v-card>
                <v-card-title class="headline grey lighten-4">Edit Account</v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <el-alert class="notification" type="error" v-if="editNotif.error" :title="editNotif.errorMsg" :closable="false"/>
                        <el-alert class="notification" type="success" v-if="editNotif.success" :title="editNotif.successMsg" :closable="false"/>

                        <el-input class="input" placeholder="Name" v-model="editUserData.fullname"></el-input>
                        <el-input class="input" placeholder="Username" v-model="editUserData.username"></el-input>
                        <el-input class="input" placeholder="Email" v-model="editUserData.email"></el-input>

                        <br />
                        <br />

                        <p>
                            <small>Fill only if you are changing password</small>
                        </p>

                        <el-input class="input" placeholder="Password" type="password" v-model="editUserData.password"></el-input>
                        <el-input class="input" placeholder="Confirm Password" type="password" v-model="editUserData.password_confirm"></el-input>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green darken-1" flat @click.native="openModalAccount = false">Close</v-btn>
                    <v-btn color="green darken-1" flat @click.prevent="saveAccount" :disabled="errors.has('name.serial')">Save</v-btn>
                </v-card-actions>
                </v-card>
            </v-dialog>
</div>
</template>

<script>
import { mapGetters , mapState} from 'vuex'
import store from '../../../store/store'
import router from '../../../router/router';

let interval, haltCheck = false;

export default {
    data(){
        return{
            items:[
                { title: 'Accounts', command: 'account' },
                { title: 'Logout', command: 'logout' }
            ],
            kitSwitch: false,
            logout: false,
            bottomNav: 'overview',
            value: '',

            openModalAccount: false,
            editNotif:{
                error: false,
                success: false,
                errorMsg: null,
                successMsg: null
            },

            editUserData: {}
        }
    },
    methods:{
        // overview(){ this.$router.push({path: 'overview'})},
        kits(){ this.$router.push({path: 'kits'})},
        pictures(){ this.$router.push({path: 'pictures'})},
        logs(){ this.$router.push({path: 'logs'})},

        handleCommand(command){
            if(command == 'account'){
                this.openModalAccount = true
            }else{
                this.logout = true;
                Vue.auth.logout(this.logout);
            }
        },

        loadKitStatus(){
            Vue.kit.getStatus(this).then(response => {
                if (haltCheck) {
                    haltCheck = false

                    return
                }

                this.kitSwitch = response.data == 1
            })
        },

        saveAccount() {
            this.editNotif.error = false
            this.editNotif.errorMsg = null

            if (this.editUserData.password && this.editUserData.password != this.editUserData.password_confirm) {
                this.editNotif.error = true
                this.editNotif.errorMsg = 'Password does not match'

                return
            }

            Vue.auth.setUser(this.editUserData)
                .then(response => {
                    Vue.auth.user()

                    this.openModalAccount = false
                })
                .catch(error => {
                    let errors = []
                    let keys = Object.keys(error.response.data.errors)

                    for (var i = 0; i < keys.length; i++) {
                        error.response.data.errors[keys[i]].forEach(entry => {
                            errors.push(entry)
                        })
                    }

                    this.editNotif.error = true
                    this.editNotif.errorMsg = errors.join("\n")
                })
        }
    },
    watch: {
        kitSwitch(value){
            haltCheck = true

            Vue.kit.setStatus(this, value)
        }
    },
    created(){
        Vue.auth.user()
    },
    mounted(){
        interval = setInterval(this.loadKitStatus, 1000)

        Vue.auth.getUser().then(response => {
            this.editUserData = response.data
        })
    },
    beforeDestroy(){
        clearInterval(interval)
    },
    computed:{
        ...mapGetters([
            'userData',
            'kitData',
            'selectedKitData'
        ])
    }
}
</script>

<style scoped>
.v-divider{
  margin: 0 !important;
}
.main-container {
  margin: 0;
  padding: 0;
}
.navbar{
  background-color: white;
  padding: 0;
  margin: 0;
  height: 77px !important;
}
.v-toolbar{
  box-shadow: none;
  padding-top: 10px;
  padding-bottom: 10px;
  height: 77px;
  background-color: #039BE5;
}

.sidebar{
  height: 100vh;
  width: 256px;
  border: 0px;
}
.main{
  padding: 0;
}
.online{
    color: greenyellow;
    margin-right: 5px;
    margin-bottom: 2px;

}
.offline{
    margin-right: 5px;
    margin-bottom: 2px;
}
.side-title {
  text-align: center;
  padding-top: 10px;
  padding-bottom: 10px;
}

.side-title h1{
  font-weight: 600;
  font-size: 16px !important;
  display: inline-flex;
  color: white;
}
.side-title h2{
  font-weight: 400;
  font-size: 16px !important;
  display: inline-flex;
  color:   whitesmoke;
}
.side_title {
  font-weight: 500;
  font-size: 14px;
}
.side-menu {
    width: 256px !important;
}
.side-menu span{
  font-weight: 500;
}
.navbottom{
    bottom: 0;
    position: absolute;
}
.icon {
  margin-left: 12px;
  margin-right: 20px;
  width: 14px !important;
  color: white;
}

.name{
  font-weight: 600;
  font-size: 18px;
  right: 0;
  color: white;
}
.email{
  font-weight: 400;
  font-size: 12px;
  color: lightblue;
}
.button{
  width: 57px !important;
  height: 57px !important;
  margin: 0;
  padding: 0;
}
.divider{
  margin-left: 15px !important;
  margin-right: 24px !important;
  max-height: 57px !important;
  min-height: 57px !important;
}
</style>
