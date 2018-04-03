import Vue from 'vue'
import VueResource from 'vue-resource'
import { getToken } from '../utils/auth'

Vue.use(VueResource)

/* function to add/signup users to the app */
export const saveUser = (formData) => {
  return Vue.http.post('/api/user', { content: formData, params: { 'token': getToken() } })
}

/* function to fetch all the users from the api */
export const getUsers = () => {
  return Vue.http.get('/api/user/list', { params: { 'token': getToken() }} )
}

