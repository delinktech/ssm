import Vue from 'vue'
import VueResource from 'vue-resource'
import { getToken } from '../utils/auth'

Vue.use(VueResource)

/* fetch all users function via api */
export const getResults = () => {
  return Vue.http.get('/api/results', { params: { 'token': getToken() }} )
}

/* fetch results by student through api */
export const getStudentResults = (_id) => {
  return Vue.http.get(`/api/results/student/${_id}`, { params: { 'token': getToken() }} )
}

/* save result through the api */
export const saveUpload = (formData) => {
  return Vue.http.post('/api/results', formData, { params: { 'token': getToken() }} )
}

/* save edits of parent through the api */
export const saveEditResult = (formData) => {
  return Vue.http.put('/api/results', formData, { params: { 'token': getToken() }} )
}

/* delete a parent through the api */
export const deleteResult = (_id) => {
  return Vue.http.delete(`/api/result/${_id}`, { params: {'token': getToken() }} )
}
