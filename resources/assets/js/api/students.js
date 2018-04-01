// import request from '../utils/request'
import Vue from 'vue'
import VueResource from 'vue-resource'
import { getToken } from '../utils/auth'

Vue.use(VueResource)

export const getStudents = () => {
  return Vue.http.get('/api/students', { params: { 'token': getToken() }} )
}
