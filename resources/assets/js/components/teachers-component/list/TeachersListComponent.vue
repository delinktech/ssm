<template>
	<div id="teachers-list">
		<!-- TODO: display list of teachers here -->
    <h3>LIST OF TEACHERS ;)</h3>
	</div>
</template>

<script>
  export default {
    name: 'TeachersListComponent',
    data: () => {
      return {
        teachers: []
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
          this.teachers = res;
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
