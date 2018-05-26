<template>
  <div class="app-container">
    <grouped-results :results="resultsList"></grouped-results>
  </div>
</template>

<script>
  import GroupedResults from './components/GroupedResults'
  import { getResults } from '../../../api/results'

  export default {
    name: 'AllResutsComponent',
    components: {
      GroupedResults
    },
    data() {
      return {
        resultsList: null
      }
    },
    created() {
      this.fetchResults()
    },
    methods: {
      fetchResults() {
        getResults()
          .then(response => {
            console.log('results', response)
            this.resultsList = response.data.results
          })
          .catch(err => {
            // error getting results
            console.log(err)
          })
      }
    }
  }
</script>

<style scoped>

</style>
