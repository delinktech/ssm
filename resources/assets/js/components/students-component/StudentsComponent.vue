<template>
  <div id="view-students">
    <h1>View all students</h1>
    <router-view></router-view>
  </div>
</template>

<script>
  export default {
    name: 'StudentsComponent',
    data() {
      return {
        students: [],
        student: {
          student_reg: '',
          student_firstName: '',
          student_secondName: '',
          student_surName: '',
          student_gender: '',
          student_parent: '',
          student_class: '',
          student_dob: '',
        },
        student_id: '',
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
