<template>
    <div>
        <v-toolbar flat class="toolbar" height="56px">
             <!-- PAGE TITLE -->
            <v-toolbar-title class="title">LOGS</v-toolbar-title>
            <v-spacer></v-spacer>

        </v-toolbar>
        <v-divider class="divider"></v-divider>
        <v-container class="container" justify-center>
            <v-data-table :headers="headers" :items="entries" hide-actions disable-initial-sort class="elevation-1">
                <template slot="items" slot-scope="props">
                    <td>{{ props.item.message }}</td>
                    <td>{{ props.item.created_at }}</td>
                </template>
            </v-data-table>
        </v-container>
    </div>
</template>

<script>
import store from '../../../../store/store'

let interval;

export default {
  data(){
    return {
        headers: [
            { text: 'Message', value: 'message', sortable: false },
            { text: 'Timestamp', value: 'created_at', sortable: false }
        ],
        entries: []
    }
  },
  created(){
    this.$root.pageTitle = 'LOGS'
  },
  mounted(){
    interval = setInterval(this.load, 1000)
  },
  beforeDestroy(){
    clearInterval(interval)
  },
  methods: {
    load(){
        Vue.kit.logs(this).then(response => {
            this.entries = response.data
        })
    }
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
