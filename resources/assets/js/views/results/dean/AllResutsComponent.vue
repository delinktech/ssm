<template>
  <div class="app-container">
    <grouped-results></grouped-results>
  </div>
</template>

<script>
  import GroupedResults from './components/GroupedResults'

  export default {
    name: 'AllResutsComponent',
    components: {
      GroupedResults
    },
  }
</script>

<style scoped>

</style>
