<template>

<div class="sidebar-menu">
  <md-list>
    <md-list-item>
      <md-icon>dashboard</md-icon>
      <span class="md-list-item-text">
        <router-link to="/dashboard">Dashboard</router-link>
      </span>
    </md-list-item>

    <md-list-item md-expand>
      <md-icon>list</md-icon>
      <span class="md-list-item-text">Students</span>

      <md-list slot="md-expand">
        <md-list-item class="md-inset"><router-link to="/students/list">List Students</router-link></md-list-item>
        <md-list-item class="md-inset"><router-link to="/students/add">Add Students</router-link></md-list-item>
      </md-list>
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
</div>
</template>

<script>
export default {
  name: 'SidebarMenu'
}
</script>

<style>
  
</style>
