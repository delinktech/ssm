<template>
	<div id="teachers-list">
		<h2>List of all Teachers</h2>
    <md-table>
    <!-- {{teachers}} -->
      <md-table-row>
          <md-table-head>No.</md-table-head>
          <md-table-head>Registration</md-table-head>
          <md-table-head>Name</md-table-head>
          <md-table-head>Last Name</md-table-head>
          <md-table-head>Email</md-table-head>
          <md-table-head>Id No</md-table-head>
          <md-table-head>Actions</md-table-head>
      </md-table-row>
      <md-table-row v-for="teacher, index in teachers" :key="teacher.id">
        <md-table-cell>{{++index}}</md-table-cell>
        <md-table-cell>{{teacher.teacher_code}}</md-table-cell>
        <md-table-cell>{{teacher.first_name}}</md-table-cell>
        <md-table-cell>{{teacher.teacher_surname}}</md-table-cell>
        <md-table-cell>{{teacher.teacher_email}}</md-table-cell>
        <md-table-cell>{{teacher.teacher_id_number}}</md-table-cell>

        <md-table-cell>
          <md-button @click="editStudent(teacher.id)" class="md-icon-button">
            <md-icon>edit</md-icon>
          </md-button>
          <md-button @click="deleteTeacher(teacher.id)" class="md-icon-button">
            <md-icon>delete</md-icon>
          </md-button>
        </md-table-cell>
      </md-table-row>
    </md-table>

    <md-snackbar :md-position="position" :md-duration="4000" :md-active.sync="showSnackbar" md-persistent>
      <span>ERROR: Getting list of Teachers</span>
      <md-button class="md-primary" @click="fetchTeachers()">Retry</md-button>
    </md-snackbar>
	</div>
</template>

<script>
  export default {
    name: 'TeachersListComponent',
    data: () => {
      return {
        teachers: [],
        _id: '',
        pagination: {},
        edit: false,
        showSnackbar: false,
        position: 'center',
      }
    },

    created() {
      this.fetchTeachers();
    },

    methods: {
      // fetch all teachers
      fetchTeachers() {
        fetch('api/teachers')
        .then(res => res.json())
        .then(res => {
          // all good
          console.log('results', res);
          this.teachers = res.data;
        })
        .catch(err => {
          console.log('ERROR: getting teachers ->', err);
          // TODO: add snackbar here
        })
      },

      // delete a single teacher
      deleteTeacher(_id) {
        if (confirm('Are you sure want to delete the teacher?')) {
          fetch(`api/teacher/${_id}`, { method: 'delete' })
          .then(res => res.json())
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
      }
    }
  }
</script>

<style scoped>
  
</style>
