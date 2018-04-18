// import request from '../utils/request'
import Vue from 'vue'
import VueResource from 'vue-resource'
import { getToken } from '../utils/auth'

Vue.use(VueResource)

/* get all the teachers through the api */
export const getTeachers = () => {
  return Vue.http.get('/api/teachers', { params: { 'token': getToken() }} )
}

/* get a single teacher through the api */
export const getTeacher = (_id) => {
  return Vue.http.get(`/api/teacher/${_id}`, { params: {'token': getToken() }} )
}

/* edit a single teacher through the api */
export const updateTeacher = (formData) => {
  return Vue.http.put('/api/teacher', formData, { params: {'token': getToken() }} )
}

/* delete a teacher through the api */
export const deleteTeacher = (_id) => {
  return Vue.http.delete(`/api/teacher/${_id}`, { params: {'token': getToken() }} )
}