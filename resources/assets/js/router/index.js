import Vue from 'vue'
import Router from 'vue-router'

// in development-env not use lazy-loading, because lazy-loading too many pages will cause webpack hot update too slow. so only in production use lazy-loading;
// detail: https://panjiachen.github.io/vue-element-admin-site/#/lazy-loading

Vue.use(Router)

/* Layout */
import Layout from '../views/layout/Layout'

/**
* hidden: true                   if `hidden:true` will not show in the sidebar(default is false)
* alwaysShow: true               if set true, will always show the root menu, whatever its child routes length
*                                if not set alwaysShow, only more than one route under the children
*                                it will becomes nested mode, otherwise not show the root menu
* redirect: noredirect           if `redirect:noredirect` will no redirct in the breadcrumb
* name:'router-name'             the name is used by <keep-alive> (must set!!!)
* meta : {
    title: 'title'               the name show in submenu and breadcrumb (recommend set)
    icon: 'svg-name'             the icon show in the sidebar,
  }
**/

/**
 * list of users available
 * @param Admin | @param HeadMaster | @param Dean | @param Teacher
 * -> admin show all the routes                       [have all the power add{ schools, users}]
 * -> hedmaster show all school info disable edits    [can view all reports and every record of school cant make edits]
 * -> Dean show all school routes enable edits        [can add {teachers, students, classes}, edit of the same, approve results & send notifications]
 * -> teacher disable some edits                      [can add students, upload results, view list users and teachers disable{adding teachers, users, deleting}]
 */

/**
 * function return the view to display by pasing the name of the file
 * @param {'name'} name
 */
function view(name) {
  return function(resolve) {
    require(['../views/' + name], resolve)
  }
}

export const constantRouterMap = [
  { path: '/login', component: view('login/index'), hidden: true },
  { path: '/404', component: view('404'), hidden: true },

  {
    path: '',
    component: Layout,
    redirect: '/dashboard',
    name: 'dashboard',
    children: [{
      path: 'dashboard',
      component: view('dashboard/index'),
      meta: { title: 'Dashboard', icon: 'dashboard' }
    }]
  },
  {
    path: '/classes',
    component: Layout,
    redirect: '/classes/list',
    name: 'Class',
    meta: { title: 'Class', icon: 'library_books' },
    children: [
      {
        path: 'list',
        name: 'list_class',
        component: view('classes/list/ClassListComponent'),
        meta: { title: 'Class List' }
      },
      {
        path: 'add',
        name: 'add_class',
        component: view('classes/add/ClassAddComponent'),
        meta: { title: 'Class Add' }
      }
    ]
  },
  {
    path: '/students',
    component: Layout,
    redirect: '/students/list',
    name: 'Students',
    meta: { title: 'Students', icon: 'list' },
    children: [
      {
        path: 'list',
        name: 'list_student',
        component: view('students/list/StudentListComponent'),
        meta: { title: 'Students List' }
      },
      {
        path: 'add',
        name: 'add_student',
        component: view('students/add/StudentAddComponent'),
        meta: { title: 'Students Add' }
      },
      {
        hidden: true,
        path: 'records',
        name: 'StudentRecord',
        component: view('students/list/StudentDetailComponent'),
        meta: { title: 'Students Detail' }
      }
    ]
  },
  {
    path: '/teachers',
    component: Layout,
    redirect: '/teachers/list',
    name: 'Teachers',
    meta: { title: 'Teachers', icon: 'list' },
    children: [
      {
        path: 'list',
        name: 'list_teacher',
        component: view('teachers/list/TeacherListComponent'),
        meta: { title: 'Teachers List' }
      },
      {
        path: 'add',
        name: 'add_teacher',
        component: view('users/add/UsersAddComponent'),
        meta: { title: 'Teachers Add' }
      }
    ]
  },
  {
    path: '/results',
    component: Layout,
    redirect: '/results/upload',
    name: 'results',
    meta: { title: 'Results', icon: 'cloud_upload' },
    children: [
      {
        path: 'upload',
        name: 'upload',
        component: view('results/upload/ResultsUploadComponent'),
        meta: { title: 'Upload' }
      },
      {
        path: 'approve',
        name: 'approve',
        component: view('results/dean/AllResutsComponent'),
        meta: { title: 'Approve' }
      }
    ]
  },
  {
    path: '/schools',
    component: Layout,
    redirect: '/schools/list',
    name: 'schools',
    meta: { title: 'Schools', icon: 'school' },
    children: [
      {
        path: 'list',
        name: 'list_school',
        component: view('schools/list/SchoolsListComponent'),
        meta: { title: 'All Schools' }
      },
      {
        path: 'add',
        name: 'add_school',
        component: view('schools/add/SchoolAddComponent'),
        meta: { title: 'Add School' }
      }
    ]
  },
  {
    path: '/users',
    component: Layout,
    redirect: '/users/list',
    name: 'users',
    meta: { title: 'Users', icon: 'account_circle' },
    children: [
      {
        path: 'list',
        name: 'list_users',
        component: view('users/list/UsersListComponent'),
        meta: { title: 'Users List' }
      },
      {
        path: 'add',
        name: 'add_users',
        component: view('users/add/UsersAddComponent'),
        meta: { title: 'Add Users' }
      }
    ]
  },
  { path: '*', redirect: '/404', hidden: true }
]

export default new Router({
  scrollBehavior: () => ({ y: 0 }),
  mode: 'history',
  routes: constantRouterMap
})

