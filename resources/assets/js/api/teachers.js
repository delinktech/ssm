// import request from '../utils/request'
import Vue from 'vue'
import VueResource from 'vue-resource'
import { getToken } from '../utils/auth'

Vue.use(VueResource)

export const getTeachers = () => {
  return Vue.http.get('/api/teachers', { params: { 'token': getToken() }} )
}
