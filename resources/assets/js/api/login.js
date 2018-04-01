import request from '../utils/request'
import Vue from 'vue'
import VueResource from 'vue-resource'

Vue.use(VueResource)

export function login(username, password) {
  const userCredentials = { 'username': username, 'password': password }
  return Vue.http.post('/api/user/login', userCredentials)
}

export function getInfo(token) {
  return Vue.http.get('/api/user/info', { params: {'token': token }} )
}

export function logout(token) {
  return Vue.http.post('/api/user/logout', { params: {'token': token }} )
}
