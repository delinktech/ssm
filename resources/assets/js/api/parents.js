import Vue from 'vue'
import VueResource from 'vue-resource'
import { getToken } from '../utils/auth'

Vue.use(VueResource)

/* fetch all users function via api */
export const getParents = () => {
  return Vue.http.get('/api/parents', { params: { 'token': getToken() }} )
}

/* save parent through the api */
export const saveParent = () => {
  return Vue.http.post('/api/parent', { params: { 'token': getToken() }} )
}

/* save edits of parent through the api */
export const saveEditParent = () => {
  return Vue.http.put('/api/parents', { params: { 'token': getToken() }} )
}

/* delete a parent through the api */
export const deleteParent = (_id) => {
  return Vue.http.delete('/api/parent', { params: {'id': _id, 'token': getToken() }} )
}
