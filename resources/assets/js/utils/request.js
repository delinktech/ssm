import axios from 'axios'
import { apiBaseUrl } from '../config'
import { Message, MessageBox } from 'element-ui'
import store from '../store'
import { getToken } from './auth'

// Create axios instance
const service = axios.create({
  // baseURL: process.env.BASE_API, // api of base_url
  baseURL: apiBaseUrl,
  timeout: 15000 // request timeout
})

// request interceptor
service.interceptors.request.use(config => {
  if (store.getters.token) {
    config.headers['X-Token'] = getToken() // Let each request carry a custom token Please modify it according to the actual situation
  }
  return config
}, error => {
  // Do something with request error
  console.log(error) // for debug
  Promise.reject(error)
})

service.interceptors.response.use(
  response => {
  /**
  * The code is non-20000 error-free
  */
    const res = response.data
    if (res.code !== 20000) {
      Message({
        message: res.message,
        type: 'error',
        duration: 5 * 1000
      })

      if (res.code === 50008 || res.code === 50012 || res.code === 50014) {
        MessageBox.confirm('You have been logged out, you can cancel to stay on this page, or log in again', 'Confirm logout', {
          confirmButtonText: 're-register',
          cancelButtonText: 'cancel',
          type: 'warning'
        }).then(() => {
          store.dispatch('FedLogOut').then(() => {
            location.reload()
          })
        })
      }
      return Promise.reject('error')
    } else {
      return response.data
    }
  },
  error => {
    console.log('err' + error)// for debug
    Message({
      message: error.message,
      type: 'error',
      duration: 5 * 1000
    })
    return Promise.reject(error)
  }
)

export default service
