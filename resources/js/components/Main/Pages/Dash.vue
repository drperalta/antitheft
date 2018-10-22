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
					<el-menu-item index="overview" @click="overview">
						<v-icon class="icon">dashboard</v-icon>
						<span class="side_title">Overview</span>
					</el-menu-item><v-divider></v-divider>
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
					<!-- KITS -->
					<el-menu-item index="kits" @click="kits">
						<v-icon class="icon">settings_cell</v-icon>
						<span class="side_title">Kits</span>
					</el-menu-item><v-divider></v-divider>
				</div>
			</el-menu>
		</el-aside>

		<el-container>
			<!-- NAVBAR -->
			<el-header class="navbar">
                <v-toolbar class="v-toolbar" flat>

                    <!-- SELECTED KIT -->
                    <el-select class="select" v-model="value" placeholder="Select your Kit">
                        <el-option v-for="kit in Kit" :key="kit.id" :label="kit.name" :value="kit.id"></el-option>
                    </el-select>
                    <v-spacer></v-spacer>
                    <!-- BADGES -->

                    <!-- NAME AND EMAIL -->
                    <div class="hidden-xs-only">
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
			<el-main class="main">
				<router-view></router-view>
			</el-main>

			<!-- BOTTOM NAVBAR -->
			<el-footer class="hidden-md-and-up">
				<v-bottom-nav class="navbottom" :value="true" :active.sync="bottomNav" shift color="#262F3D">
                    <v-btn flat dark @click="overview" value="overview" color="#4FC3F7">
                        <v-icon>dashboard</v-icon>
                    </v-btn>

                    <v-btn flat dark @click="pictures" value="pictures" color="#4FC3F7">
                        <v-icon>photo</v-icon>
                    </v-btn>

                    <v-btn flat dark @click="logs" value="logs" color="#4FC3F7">
                        <v-icon>subject</v-icon>
                    </v-btn>

                    <v-btn flat dark @click="kits" value="kits" color="#4FC3F7">
                        <v-icon>settings_cell</v-icon>
                    </v-btn>
				</v-bottom-nav>
			</el-footer>
		</el-container>
	</el-container>
</div>
</template>

<script>
export default {
    data(){
        return{
            items:[
                { title: 'Accounts', command: 'account' },
                { title: 'Logout', command: 'logout' }
            ],
            logout: false,
            bottomNav: 'overview',
            value: ''
        }
    },
    methods:{
        overview(){ this.$router.push({path: 'overview'})},
        kits(){ this.$router.push({path: 'kits'})},
        pictures(){ this.$router.push({path: 'pictures'})},
        logs(){ this.$router.push({path: 'logs'})},

        handleCommand(command){
            if(command == 'account'){
                this.$router.push({path: 'account'})
            }else{
                this.logout = true;
                Vue.auth.logout(this.logout);
            }
        },
    },

    created(){
        Vue.auth.user()
    },
    mounted(){
        Vue.kit.set()
    },
    computed:{
        userData(){
            return this.$store.state.userData[0]
        },
        Kit(){
            return this.$store.state.kitData[0]
        }
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
  height: 100%;
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
