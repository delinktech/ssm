// import request from '../utils/request'
import Vue from 'vue'
import VueResource from 'vue-resource'

Vue.use(VueResource)

export const getStudents = () => {
  return Vue.http.get('http://dev.ssm.io/api/students')
  // return fetch({
  //   url: 'dev.ssm.io/api/students',
  //   method: 'get'
  // })
}
