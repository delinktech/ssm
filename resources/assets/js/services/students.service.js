import repository from './repository.service';

export default class StudentsService {

  getAllStudents() {
    /* 
      fucntion to fetch students from the databse
    */
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
  }

  /*
    function to delete a student from the database
  */
  deleteStudent(id) {
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