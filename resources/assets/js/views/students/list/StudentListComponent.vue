<template>
  <div class="app-container">
    <h3>List of Students <small>{{school.school_name}}</small></h3>

    <el-table :data="list" v-loading.body="listLoading" element-loading-text="Loading" highlight-current-row>
      <el-table-column align="center" label='ID'>
        <template slot-scope="scope">
          {{scope.$index+1}}
        </template>
      </el-table-column>
      <el-table-column label="Registration">
        <template slot-scope="scope">
          {{scope.row.student_reg}}
        </template>
      </el-table-column>
      <el-table-column label="Class">
        <template slot-scope="scope">
          {{scope.row.class_id.code}}
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
      <el-table-column label="Sex" align="center">
        <template slot-scope="scope">
          {{scope.row.student_gender}}
        </template>
      </el-table-column>
      <el-table-column label="Parent" align="center">
        <template slot-scope="scope">
          {{scope.row.student_parent.parent_first_name}} {{scope.row.student_parent.parent_second_name}}
        </template>
      </el-table-column>
      <el-table-column label="Phone" align="center">
        <template slot-scope="scope">
          {{scope.row.student_parent.parent_Phone_number}}
        </template>
      </el-table-column>
      <el-table-column label="Age" align="center">
        <template slot-scope="scope">
          {{scope.row.student_dob | age}}
        </template>
      </el-table-column>
      <el-table-column label="Operations">
        <template slot-scope="scope">
          <el-button @click="editStudent(scope.row)" type="text" size="small"><md-icon>edit</md-icon></el-button>
          <el-button @click="confirmDeleteStudent(scope.row.id)" type="text" size="small"><md-icon>delete</md-icon></el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
  import moment from 'moment'
  import { mapGetters } from 'vuex'
  import { getStudents, deleteStudent } from '../../../api/students'

  export default {
    name: 'StudentListComponent',
    data() {
      return {
        list: null,
        listLoading: true
      }
    },
    computed: {
      ...mapGetters([
        'school'
      ])
    },
    filters: {
      age(value) {
        const age = moment().diff(value, 'years')
        return age
      }
    },
    created() {
      this.fetchData()
    },
    methods: {
      successMesssage() {
        this.$message({
          message: 'Student delete successfuly',
          type: 'success'
        });
      },
      errorMessage(oppr) {
        this.$message({
          message: `Error, ${oppr} try again later`,
          type: 'error'
        });
      },
      fetchData() {
        this.listLoading = true
        getStudents()
          .then(response => {
            // console.log('students', response)
            this.list = response.data.students
            this.listLoading = false
          })
          .catch(err => {
            console.log(err)
            this.listLoading = false
            this.errorMessage('fetching Students!')
          })
      },
      confirmDeleteStudent(id) {
        this.$confirm('Are you sure you want to delete this student?')
          .then(_ => {
            // call function to delete the student
            this.deleteStudent(id)

            done();
          })
          .catch(_ => {
            // do nothing
          });
      },
      deleteStudent(_id) {
        deleteStudent(_id)
          .then(res => {
            // fetch the list of students again
            this.fetchData()

            // display success message
            this.successMesssage()
            console.log(res)
          })
          .catch(err => {
            // display error message to the user
            this.errorMessage('deleting Student!')
            console.log('error =>', err)
          })
      },
      editStudent(student) {
        console.log('student', student)
      }
    }
  }
</script>

<style scoped>

</style>
