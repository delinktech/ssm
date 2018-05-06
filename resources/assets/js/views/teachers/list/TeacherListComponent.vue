<template>
  <div class="app-container">
    <el-table :data="list" v-loading.body="listLoading" element-loading-text="Loading" highlight-current-row>
      <el-table-column align="center" label='ID'>
        <template slot-scope="scope">
          {{scope.$index+1}}
        </template>
      </el-table-column>
      <el-table-column label="Id Number">
        <template slot-scope="scope">
          {{scope.row.teacher_id_number}}
        </template>
      </el-table-column>
      <el-table-column label="First Name">
        <template slot-scope="scope">
          {{scope.row.first_name}}
        </template>
      </el-table-column>
      <el-table-column label="SurName" align="center">
        <template slot-scope="scope">
          <span>{{scope.row.teacher_surname}}</span>
        </template>
      </el-table-column>
      <el-table-column label="Email" align="center">
        <template slot-scope="scope">
          {{scope.row.teacher_email}}
        </template>
      </el-table-column>
      <el-table-column label="Code" align="center">
        <template slot-scope="scope">
          {{scope.row.teacher_code}}
        </template>
      </el-table-column>
      <el-table-column label="Operations">
        <template slot-scope="scope">
          <el-button @click="editTeacher(scope.row)" type="text" size="small"><md-icon>edit</md-icon></el-button>
          <el-button @click="confirmDeleteTeacher(scope.row.id)" type="text" size="small"><md-icon>delete</md-icon></el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
  import { getTeachers, deleteTeacher } from '../../../api/teachers'

  export default {
    name: 'TeacherListComponent',
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
      successMesssage() {
        this.$message({
          message: 'Teacher delete successfuly',
          type: 'success'
        });
      },
      errorMessage(action) {
        this.$message({
          message: `Oops!, an error occured while ${action}, try again later`,
          type: 'error'
        });
      },
      fetchData() {
        this.listLoading = true
        getTeachers().then(response => {
          this.list = response.data.data
          this.listLoading = false
        })
          .catch(err => {
            //  call error message to dislay to the user
            this.errorMessage('fetching teachers')
            console.log(err)
          })
      },
      confirmDeleteTeacher(id) {
        this.$confirm('Are you sure you want to delete this teacher?')
          .then(_ => {
            // call function to delete the teacher
            this.deleteTeacher(id)
            
            done();
          })
          .catch(_ => {
            // do nothing
          });
      },
      deleteTeacher(_id) {
        deleteTeacher(_id)
          .then(res => {
            // fetch the list of teachers again
            this.fetchData()

            // display success message
            this.successMesssage()
          })
          .catch(err => {
            // display error message to the user
            this.errorMessage('deleting a teacher')
            console.log('error =>', err)
          })
      },
      editTeacher(teacher) {
        console.log('teacher', teacher)
      }
    }
  }
</script>

<style scoped>
  
</style>
