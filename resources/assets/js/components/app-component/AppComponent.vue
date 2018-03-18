<template>
  <div id="app">

    <div class="page-container">
      <md-app>
        <md-app-toolbar class="md-primary" md-elevation="0">
          <!-- <md-card class="card-toolbar"> -->
            <md-button class="md-icon-button" @click="toggleMenu" v-if="!menuVisible">
              <md-icon>menu</md-icon>
            </md-button>
            <span class="md-title">My Title</span>
          <!-- </md-card> -->
        </md-app-toolbar>

        <md-app-drawer :md-active.sync="menuVisible" md-persistent="mini">
          <md-toolbar class="md-transparent" md-elevation="0">
            <span>Navigation</span>

            <div class="md-toolbar-section-end">
              <md-button class="md-icon-button md-dense" @click="toggleMenu">
                <md-icon>keyboard_arrow_left</md-icon>
              </md-button>
            </div>
          </md-toolbar>

          <!-- side menu -->
          <Sidebar/>
          
        </md-app-drawer>

        <md-app-content>
          <!-- router -->
          <router-view/>
        </md-app-content>

      </md-app>
    </div>

  </div>
</template>

<script>
  import Sidebar from '../sidebar-component/SidebarComponent'
  export default {
    name: 'AppComponent',
    components: {
      Sidebar
    },
    data: () => ({
      menuVisible: false
    }),
    methods: {
      toggleMenu () {
        this.menuVisible = !this.menuVisible
      }
    }
  }
</script>

<style scoped>
  .md-app {
    min-height: 450px;
    border: 1px solid rgba(#000, .12);
  }

  /*Demo purposes only*/
  .md-drawer {
    width: 230px;
    max-width: calc(100vw - 125px);
  }

  .card-toolbar {
    width: 100%;
    min-height: 48px;
  }
</style>
