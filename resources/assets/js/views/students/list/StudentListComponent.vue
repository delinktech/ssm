<template>
  <div class="app-container">
    <el-table :data="list" v-loading.body="listLoading" element-loading-text="Loading" border fit highlight-current-row>
      <el-table-column align="center" label='ID'>
        <template slot-scope="scope">
          {{scope.$index+1}}
        </template>
      </el-table-column>
      <el-table-column label="First Name">
        <template slot-scope="scope">
          {{scope.row.student_first_name}}
        </template>
      </el-table-column>
      <el-table-column label="Last Name" align="center">
        <template slot-scope="scope">
          <span>{{scope.row.student_last_surname}}</span>
        </template>
      </el-table-column>
      <el-table-column label="Parent" align="center">
        <template slot-scope="scope">
          {{scope.row.student_parent}}
        </template>
      </el-table-column>
      <!-- <el-table-column class-name="status-col" label="Status" width="110" align="center">
        <template slot-scope="scope">
          <el-tag :type="scope.row.status | statusFilter">{{scope.row.status}}</el-tag>
        </template>
      </el-table-column> -->
      <!-- <el-table-column align="center" prop="created_at" label="Display_time" width="200">
        <template slot-scope="scope">
          <i class="el-icon-time"></i>
          <span>{{scope.row.display_time}}</span>
        </template>
      </el-table-column> -->
    </el-table>
  </div>
</template>

<script>
  import { getStudents } from '../../../api/students'

  export default {
    name: 'StudentListComponent',
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
        getStudents().then(response => {
          this.list = response.data.data
          this.listLoading = false
        })
          .catch(err => {
            // TODO: add a snackbar
            console.log(err)
          })
      }
    }
  }
</script>

<style scoped>
  
</style>
