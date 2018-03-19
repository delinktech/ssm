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

    }
  }
</script>

<style scoped>
  
</style>
