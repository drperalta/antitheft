<template>
  <div>
    <el-container class="main-container">
      <!-- SIDEBAR -->
      <el-aside >
        <el-menu class="sidebar">
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
          <el-menu-item index="1" @click="overview">
            <v-icon class="icon">fa-th-large</v-icon>
            <span>Overview</span>
          </el-menu-item>
          <el-menu-item index="2" @click="kits">
            <v-icon class="icon">fa-hdd</v-icon>
            <span>Kits</span>
          </el-menu-item>
          <el-menu-item index="3" @click="pictures">
            <v-icon class="icon">fa-image</v-icon>
            <span>Pictures</span>
          </el-menu-item>
          <el-menu-item index="4" @click="logs">
            <v-icon class="icon">fa-align-left</v-icon>
            <span>Logs</span>
          </el-menu-item>
        </div>

        <!-- SIDEBAR FOOTER -->
        </el-menu>
      </el-aside>

      <el-container>
        <!-- NAVBAR -->
        <el-header class="navbar">
          <v-toolbar class="v-toolbar" flat>
            <v-toolbar-title class="title">{{$root.pageTitle}}</v-toolbar-title>
            <v-spacer></v-spacer>
            <div>
              <h1 class="name">{{userData.fullname}}</h1>
              <p class="email">{{userData.email}}</p>
            </div>
            <v-divider class="divider" vertical></v-divider>
            <el-dropdown trigger="click" @command="handleCommand">
              <span>
                <v-icon>fa-cog</v-icon>
              </span>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item v-for="item in items"
                  :key="item.key" :command="item.command">
                  {{item.title}}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </v-toolbar>
          <v-divider></v-divider>
        </el-header>
        
        <!-- MAIN -->
        <el-main class="main">
          <div class="Main">
            <router-view></router-view>
          </div>
        </el-main>
        <!-- ///////////// -->
      </el-container>
    </el-container>
    
    
  </div>
</template>

<script>
import router from '../../../router/router'
import store from '../../../store/store'

export default {
  data(){
    return{
      items:[
        {
          title: 'Accounts',
          command: 'account'
        },
        {
          title: 'Logout',
          command: 'logout'
        }
      ]
    }
  },
  methods:{
    overview(){ router.push({path: 'overview'})},
    kits(){ router.push({path: 'kits'})},
    pictures(){ router.push({path: 'pictures'})},
    logs(){ router.push({path: 'logs'})},

    accounts(){
      alert('Accounts')
    },
    logout(){

    },
    handleCommand(command){
      if(command == 'account'){
        router.push({path: 'account'})
      }else{
        Vue.auth.logout();
      }
    },
  },
  created(){
      Vue.auth.user()
  },
  computed:{
    userData(){
      return store.state.userData[0]
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
  height: 77px !important;
}
.v-toolbar{
  box-shadow: none;
  padding-top: 10px;
  padding-bottom: 10px;
  height: 77px;
}
.title{
  font-weight: 600;
}

.sidebar{
  height: 100vh;
}
.main{
  padding: 0;
}
.side-title {
  text-align: center;
  padding-top: 10px;
  padding-bottom: 10px;
}

.side-title h1{
  font-weight: 800;
  font-size: 16px !important;
  display: inline-flex;
  color: rgb(20, 48, 107);
}
.side-title h2{
  font-weight: 800;
  font-size: 16px !important;
  display: inline-flex;
  color:   steelblue;
}

.side-menu {
  margin-top: 10px;
}
.side-menu span{
  font-weight: 500;
}

.icon {
  margin-left: 12px;
  margin-right: 20px;
  width: 10px;
}

.name{
  font-weight: 600;
  font-size: 18px;
  right: 0;
}
.email{
  font-weight: 400;
  font-size: 12px;
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
