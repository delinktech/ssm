import Vue from 'vue'
import VueResource from 'vue-resource'
import { getToken } from '../utils/auth'

Vue.use(VueResource)

/* fetch all users function via api */
export const getStudents = () => {
  return Vue.http.get('/api/students', { params: { 'token': getToken() }} )
}

/* save student through the api */
export const saveStudent = () => {
  return Vue.http.post('/api/students', { params: { 'token': getToken() }} )
}

/* save edits of student through the api */
export const saveEditStudent = () => {
  return Vue.http.put('/api/students', { params: { 'token': getToken() }} )
}

/* delete a student through the api */
export const deleteStudent = (_id) => {
  return Vue.http.delete('/api/students', { params: {'id': _id, 'token': getToken() }} )
}
