<template>
  <div class="app-container">
    <h3>List of All Classes</h3>
    <el-table :data="list" v-loading.body="listLoading" element-loading-text="Loading" border fit highlight-current-row>
      <el-table-column align="center" label='ID'>
        <template slot-scope="scope">
          {{scope.$index+1}}
        </template>
      </el-table-column>
      <el-table-column label="Class Code">
        <template slot-scope="scope">
          {{scope.row.code}}
        </template>
      </el-table-column>
      <el-table-column label="Class Name" align="center">
        <template slot-scope="scope">
          <span>{{scope.row.name}}</span>
        </template>
      </el-table-column>
      <el-table-column label="Class Teacher" align="center">
        <template slot-scope="scope">
          {{scope.row.classteacher}}
        </template>
      </el-table-column>

      <el-table-column label="Operations">
        <template slot-scope="scope">
          <el-button @click="editClass(scope.row)" type="text" size="small"><md-icon>edit</md-icon></el-button>
          <el-button @click="confirmDeleteClass(scope.row.id)" type="text" size="small"><md-icon>delete</md-icon></el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
  import { getClasses, deleteClass } from '../../../api/class'

  export default {
    name: 'ClassListComponent',
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
      successMesssage() {
        this.$message({
          message: 'Class deleted successfuly',
          type: 'success'
        });
      },
      openError(err) {
        this.$message({
          message: `Oops! Something went wrong! ${err}`,
          type: 'error'
        })
      },
      fetchData() {
        this.listLoading = true

        // get classes
        getClasses()
          .then(response => {
            this.list = response.data.data

            this.listLoading = false
          })
          .catch(err => {
            // catch error and display to user
            // console.log(err)
            this.openError('fetching classes')
          })
      },
      editClass(_class) {
        console.log('class', _class)
      },
      confirmDeleteClass(_id) {
        this.$confirm('Are you sure you want to delete this Class?')
          .then(_ => {
            // call function to delete the student
            this.deleteClass(_id)
            
            done();
          })
          .catch(_ => {
            // do nothing
          });
      },
      deleteClass(_id) {
        // delete the class
        deleteClass(_id)
          .then(res => {
            // success deleted the class
            this.successMesssage()

            // call the function to refetch the data
            this.fetchData()
          })
          .catch(err => {
            // catch the error
            this.openError('deleting student')
          })
      }
    }
  }
</script>

<style scoped>
  
</style>
