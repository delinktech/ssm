import Vue from 'vue'
import VueResource from 'vue-resource'
import { getToken } from '../utils/auth'

Vue.use(VueResource)

/* fetch all users function via api */
export const getResults = () => {
  return Vue.http.get('/api/results', { params: { 'token': getToken() }} )
}

/* save result through the api */
export const saveResult = () => {
  return Vue.http.post('/api/result', { params: { 'token': getToken() }} )
}

/* save edits of parent through the api */
export const saveEditResult = () => {
  return Vue.http.put('/api/results', { params: { 'token': getToken() }} )
}

/* delete a parent through the api */
export const deleteResult = (_id) => {
  return Vue.http.delete('/api/Result', { params: {'id': _id, 'token': getToken() }} )
}
