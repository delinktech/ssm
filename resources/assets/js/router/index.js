import Vue from 'vue'
import Router from 'vue-router'

import AppComponent from '../components/app-component/AppComponent'

import StudentsComponent from '../components/students-component/StudentsComponent'
import StudentAddComponent from '../components/students-component/add/StudentAddComponent'
import StudentsListComponent from '../components/students-component/list/StudentsListComponent'
import StudentEditComponent from '../components/students-component/edit/StudentEditComponent'

Vue.use(Router)

let router = new Router({
  routes: [
    {
      path: '*',
      redirect: '/dashboard'
    },
    {
      path: '/',
      redirect: '/dashboard'
    },
    {
      path: '/dashboard',
      name: 'dashboard-component'
      // component: AppComponent
    },
    {
      path: '/students',
      name: 'students-component',
      component: StudentsComponent,
      children: [
        {
          path: 'list',
          component: StudentsListComponent
        },
        {
          path: 'edit',
          component: StudentEditComponent
        },
        {
          path: 'add',
          component: StudentAddComponent
        }
      ]
    }
  ]
})

export default router 
