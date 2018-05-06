import Vue from 'vue'
import VueResource from 'vue-resource'
import { getToken } from '../utils/auth'

Vue.use(VueResource)

/* fetch all Schools function via api */
export const getClasses = () => {
  return Vue.http.get('/api/classes', { params: { 'token': getToken() }} )
}

/* fetch single School function via api */
export const getClass = (_id) => {
  return Vue.http.get(`/api/class/${_id}`, { params: { 'token': getToken() }} )
}

/* save Schools through the api */
export const saveClass = (formData) => {
  return Vue.http.post('/api/class', formData, { params: { 'token': getToken() }} )
}

/* save edits of Schools through the api */
export const saveEditClass = (formData) => {
  return Vue.http.put('/api/class', formData, { params: { 'token': getToken() }} )
}

/* delete a Schools through the api */
export const deleteClass = (_id) => {
  return Vue.http.delete(`/api/class/${_id}`, { params: { 'token': getToken() }} )
}
