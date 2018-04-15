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
          <md-icon>edit </md-icon>
          <md-icon>delete </md-icon>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
  import { getSchools } from '../../../api/schools'

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

          // TODO: remove mocke data
          this.list = [{
            school_name: 'School of THought',
            school_code: '2567',
            school_type: 'Bording',
            school_phone: '0998765',
            school_email: 'sch@thought.com',
            school_gender: 'Mixed',
            school_county: 'Nairobi',
            school_sub_county: '',
            school_ward: '',
            school_logo: ''
          }]
          
          this.listLoading = false
        })
          .catch(err => {
            // catch error and display to user
            this.openError()
            console.log(err)
          })
      }
    }
  }
</script>

<style scoped>
  
</style>
