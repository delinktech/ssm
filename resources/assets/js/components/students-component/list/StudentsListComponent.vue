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
      </md-table-row>
    </md-table>

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
        edit: false
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
          console.log(res.data);

          // assign the data to students array
          this.students = res.data;
        })
        .catch(err => {
          console.log('Error: Getting students', err);
        })
      }
    }
  }
</script>

<style scoped>
  
</style>
