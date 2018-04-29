import Vue from 'vue'
import VueResource from 'vue-resource'
import { getToken } from '../utils/auth'

Vue.use(VueResource)

/* fetch all users function via api */
export const getParents = () => {
  return Vue.http.get('/api/parents', { params: { 'token': getToken() }} )
}

/* save parent through the api */
export const saveParent = (formData) => {
  return Vue.http.post('/api/parent', formData, { params: { 'token': getToken() }} )
}

/* save edits of parent through the api */
export const saveEditParent = (formData) => {
  return Vue.http.put('/api/parent', formData, { params: { 'token': getToken() }} )
}

/* delete a parent through the api */
export const deleteParent = (_id) => {
  return Vue.http.delete(`/api/parent${_id}`, { params: { 'token': getToken() }} )
}
