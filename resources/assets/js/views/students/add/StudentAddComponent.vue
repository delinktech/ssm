<template>
  <div class="app-container">
    add students
  </div>
</template>

<script>
  import { getStudents } from '../../../api/students'

  export default {
    name: 'StudentAddComponent',
    data() {
      return {
        list: null,
        listLoading: true
      }
    },
    filters: {
      statusFilter(status) {
        const statusMap = {
          published: 'success',
          draft: 'gray',
          deleted: 'danger'
        }
        return statusMap[status]
      }
    },
    created() {
      this.fetchData()
    },
    methods: {
      fetchData() {
        this.listLoading = true
      }
    }
  }
</script>

<style scoped>
  
</style>
