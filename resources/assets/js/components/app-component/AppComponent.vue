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

          <md-list>
            <md-list-item>
              <md-icon>move_to_inbox</md-icon>
              <span class="md-list-item-text">Inbox</span>
            </md-list-item>

            <md-list-item>
              <md-icon>send</md-icon>
              <span class="md-list-item-text">Sent Mail</span>
            </md-list-item>

            <md-list-item>
              <md-icon>delete</md-icon>
              <span class="md-list-item-text">Trash</span>
            </md-list-item>

            <md-list-item>
              <md-icon>error</md-icon>
              <span class="md-list-item-text">Spam</span>
            </md-list-item>
          </md-list>
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
  export default {
    name: 'AppComponent',
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