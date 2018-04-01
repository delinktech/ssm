<template>
  <div class="app-container">
    add teacher
  </div>
</template>

<script>
  import { getStudents } from '../../../api/teachers'

  export default {
    name: 'TeacherAddComponent',
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
