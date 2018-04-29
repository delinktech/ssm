<template>
  <div class="app-container">
    <h3>List of All Schools</h3>
    <el-table :data="list" v-loading.body="listLoading" element-loading-text="Loading" border fit highlight-current-row>
      <el-table-column align="center" label='ID'>
        <template slot-scope="scope">
          {{scope.$index+1}}
        </template>
      </el-table-column>
      <el-table-column label="Name">
        <template slot-scope="scope">
          {{scope.row.school_name}}
        </template>
      </el-table-column>
      <el-table-column label="Code" align="center">
        <template slot-scope="scope">
          <span>{{scope.row.school_code}}</span>
        </template>
      </el-table-column>
      <el-table-column label="Gender" align="center">
        <template slot-scope="scope">
          {{scope.row.school_gender}}
        </template>
      </el-table-column>
      <el-table-column label="Phone" align="center">
        <template slot-scope="scope">
          {{scope.row.school_phone}}
        </template>
      </el-table-column>
      <el-table-column label="Email" align="center">
        <template slot-scope="scope">
          {{scope.row.school_email}}
        </template>
      </el-table-column>
      <el-table-column label="County" align="center">
        <template slot-scope="scope">
          {{scope.row.school_county}}
        </template>
      </el-table-column>
      <el-table-column label="Actions" align="center">
        <template slot-scope="scope">
          <md-icon @click="editSchool(1)">edit </md-icon>
          <md-icon @click="deleteSchool(1)">delete </md-icon>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
  import { getSchools, deleteSchool } from '../../../api/schools'

  export default {
    name: 'SchoolListComponent',
    data() {
      return {
        list: null,
        listLoading: true
      }
    },
    filters: {

    },
    created() {
      this.fetchData()
    },
    methods: {
      openError() {
        this.$message({
          message: 'Oops! Something went wrong!',
          type: 'error'
        })
      },
      fetchData() {
        this.listLoading = true

        // get schools
        getSchools().then(response => {
          // this.list = response.data.data

          console.log('schools:', response.data.data)
          this.list = response.data.data

          this.listLoading = false
        })
          .catch(err => {
            // catch error and display to user
            this.openError()
            console.log(err)
          })
      },
      // delete a single school 
      deleteSchool(_id) { 
        // TODO: replce this with dialog
        if (confirm('Are you sure want to delete the school?')) {
          deleteSchool(_id) 
            .then(res => { 
              // TODO: add snackbar for success here 
   
              // fetch the teachers list again 
              this.fetchTeachers()
            })
            .catch(err => {
              console.log('ERROR: deleting teacher ->', err); 
              // TODO: add snackbar here 
            })
        }
      },
      editSchool(_id) {
        // edit selected school
      } 
    }
  }
</script>

<style scoped>
  
</style>
