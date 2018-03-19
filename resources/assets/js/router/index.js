import Vue from 'vue'
import Router from 'vue-router'

import AppComponent from '../components/app-component/AppComponent'
import DashboardComponent from '../components/dashboard-component/DashboardComponent'

import StudentsComponent from '../components/students-component/StudentsComponent'
import StudentAddComponent from '../components/students-component/add/StudentAddComponent'
import StudentsListComponent from '../components/students-component/list/StudentsListComponent'
import StudentEditComponent from '../components/students-component/edit/StudentEditComponent'

import TeachersComponent from '../components/teachers-component/TeachersComponent'
import TeachersAddComponent from '../components/teachers-component/add/TeachersAddComponent'
import TeachersListComponent from '../components/teachers-component/list/TeachersListComponent'
import TeachersEditComponent from '../components/teachers-component/edit/TeachersEditComponent'

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
      name: 'dashboard-component',
      component: DashboardComponent
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
          path: 'edit/:id',
          component: StudentEditComponent
        },
        {
          path: 'add',
          component: StudentAddComponent
        }
      ]
    },
    {
      path: '/teachers',
      name: 'teachers-component',
      component: TeachersComponent,
      children: [
        {
          path: 'list',
          component: TeachersListComponent
        },
        {
          path: 'edit/:id',
          component: TeachersEditComponent
        },
        {
          path: 'add',
          component: TeachersAddComponent
        }
      ]
    }
  ]
})

export default router 
