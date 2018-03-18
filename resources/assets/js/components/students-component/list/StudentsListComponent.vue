<template>
  <div id="edit-student">
    <h2>List of all students</h2>
    <md-table>
    <!-- {{students}} -->
      <md-table-row>
          <md-table-head>No.</md-table-head>
          <md-table-head>Registration</md-table-head>
          <md-table-head>Name</md-table-head>
          <md-table-head>Gender</md-table-head>
          <md-table-head>Class</md-table-head>
          <md-table-head>Age</md-table-head>
      </md-table-row>
      <md-table-row v-for="student in students" :key="student.student_id">
        <md-table-cell>11</md-table-cell>
        <md-table-cell>{{student.student_reg}}</md-table-cell>
        <md-table-cell>{{student.student_first_name}}</md-table-cell>
        <md-table-cell>{{student.student_gender}}</md-table-cell>
        <md-table-cell>{{student.class_id}}</md-table-cell>
        <md-table-cell>{{student.student_dob}}</md-table-cell>
          <md-button @click="deleteStudent(student.id)" class="md-icon-button">
            <md-icon>delete</md-icon>
          </md-button>
      </md-table-row>
    </md-table>

    <md-snackbar :md-position="position" :md-duration="4000" :md-active.sync="showSnackbar" md-persistent>
      <span>ERROR: Getting list of students</span>
      <md-button class="md-primary" @click="fetchStudents()">Retry</md-button>
    </md-snackbar>
  </div>
</template>

<script>
   export default {
    name: 'StudentListComponent',
    data() {
      return {
        students: [],
        student: {
          student_reg: '',
          student_first_name: '',
          student_second_name: '',
          student_surName: '',
          student_gender: '',
          student_parent: '',
          class_id: '',
          student_dob: '',
        },
        _id: '',
        pagination: {},
        edit: false,
        showSnackbar: false,
        position: 'center',
      }
    },

    created() {
      this.fetchStudents();
    },

    methods: {
      fetchStudents() {
        fetch('api/students')
        .then(res => res.json())
        .then(res => {
          // console.log(res.data);

          // assign the data to students array
          this.students = res.data;
        })
        .catch(err => {
          console.log('Error: Getting students', err);
          this.showSnackbar = true;
        })
      },

      /*method to delete a single student*/
      deleteStudent(_id) {
        // confirm if user wants to delete
        if (confirm('Are you sure you want to delete this student?')) {
          fetch(`api/student/${_id}`, {
            method: 'delete'
          })
          .then(res => res.json())
          .then(res => {
            // student delete
            // TODO: add snackbar

            // refresh the student list
            this.fetchStudents()
          })
          .catch(err => {
            // TODO: add snackbar
            console.log('ERROR: while deleting student', err);
          })
        }
      }
    }
  }
</script>

<style scoped>
  
</style>
