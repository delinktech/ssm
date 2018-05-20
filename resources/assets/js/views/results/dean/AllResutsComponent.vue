<template>
  <div class="app-container">
    <h3>All classes Results</h3>
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
