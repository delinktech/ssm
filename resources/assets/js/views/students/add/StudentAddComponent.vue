<template>
  <div class="app-container">
    <h3>Add Student</h3>

    <!-- form starts -->
    <el-form ref="form" :model="studentForm">

      <el-col :span="7">
        <el-form-item label="First Name">
          <el-input v-model="studentForm.firstName"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Second Name">
          <el-input v-model="studentForm.secondName"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Last Name">
          <el-input v-model="studentForm.lastName"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-button type="success" style="margin-top: 12px;" @click="onSubmit(form)">Save Student</el-button>
      </el-col>

    </el-form> <!-- /form ends -->

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
