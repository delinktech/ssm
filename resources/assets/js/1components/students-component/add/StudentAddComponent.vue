<template>
  <div id="add-student">

    <h2>Add student</h2>
    <form novalidate class="md-layout" @submit.prevent="validateUser">
      <md-card class="md-layout-item md-size-50 md-small-size-100">
        <md-card-header>
          <div class="md-title">Users</div>
        </md-card-header>
      </md-card>

      <md-button class="md-primary">Primary</md-button>
    </form>

  </div>
</template>

<script>
   export default {
    name: 'StudentAddComponent',
    data() {
      return {

      }
    }
  }
</script>

<style scoped>

</style>
