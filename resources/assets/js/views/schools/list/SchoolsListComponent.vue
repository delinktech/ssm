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
      <el-table-column label="Operations">
        <template slot-scope="scope">
          <el-button @click="editSchool(scope.row)" type="text" size="small"><md-icon>edit</md-icon></el-button>
          <el-button @click="confirmDeleteSchool(scope.row.id)" type="text" size="small"><md-icon>delete</md-icon></el-button>
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
    created() {
      this.fetchData()
    },
    methods: {
      successMesssage() {
        this.$message({
          message: 'School deleted successfuly',
          type: 'success'
        });
      },
      openError(err) {
        this.$message({
          message: `Oops! Something went wrong! while ${err} try again`,
          type: 'error'
        })
      },
      fetchData() {
        this.listLoading = true

        // get schools
        getSchools()
          .then(response => {
            this.list = response.data.data

            // finished loading data
            this.listLoading = false
          })
          .catch(err => {
            // catch error and display to user
            // console.log(err)
            this.openError('fetching schools')
          })
      },
      editSchool(school) {
        console.log('edit school', school)
      },
      confirmDeleteSchool(_id) {
        this.$confirm('Are you sure you want to delete this School?')
          .then(_ => {
            // call function to delete the school
            this.deleteSchool(_id)
            
            done()
          })
          .catch(_ => {
            // do nothing
          })
      },
      deleteSchool(_id) { 
        deleteSchool(_id) 
          .then(res => { 
            // open success delete
            this.successMesssage()

            // fetch the teachers list again 
            this.fetchData()
          })
          .catch(err => {
            // error deleteing
            console.log('error deleting school', err); 
            this.openError('deleting school')
          })
      }
    }
  }
</script>

<style scoped>
  
</style>
