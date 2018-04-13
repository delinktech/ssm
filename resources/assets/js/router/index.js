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

function view(name) {
  return function(resolve) {
    require(['../views/' + name], resolve)
  }
}

export const constantRouterMap = [
  { path: '/login', component: view('login/index'), hidden: true },
  { path: '/404', component: view('404'), hidden: true },

  {
    path: '/',
    component: Layout,
    redirect: '/dashboard',
    name: 'Dashboard',
    // hidden: true,
    children: [{
      path: 'dashboard',
      component: view('dashboard/index'),
      meta: { title: 'Dashboard', icon: 'dashboard' }
    }]
  },

  // {
  //   path: '/example',
  //   component: Layout,
  //   redirect: '/example/table',
  //   name: 'Example',
  //   meta: { title: 'Example', icon: 'example' },
  //   children: [
  //     {
  //       path: 'table',
  //       name: 'Table',
  //       component: () => import('.views/table/index'),
  //       meta: { title: 'Table', icon: 'table' }
  //     },
  //     {
  //       path: 'tree',
  //       name: 'Tree',
  //       component: () => import('.views/tree/index'),
  //       meta: { title: 'Tree', icon: 'tree' }
  //     }
  //   ]
  // },

  {
    path: '/students',
    component: Layout,
    redirect: '/students/list',
    name: 'Students',
    meta: { title: 'Students', icon: 'table' },
    children: [
      {
        path: 'list',
        name: 'StudentsList',
        component: view('students/list/StudentListComponent'),
        meta: { title: 'Students List' }
      },
      {
        path: 'add',
        name: 'StudentAdd',
        component: view('students/add/StudentAddComponent'),
        meta: { title: 'Students Add' }
      } 
      {
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
    meta: { title: 'Teachers', icon: 'table' },
    children: [
      {
        path: 'list',
        name: 'TeachersList',
        component: view('teachers/list/TeacherListComponent'),
        meta: { title: 'Teachers List' }
      },
      {
        path: 'add',
        name: 'TeachersAdd',
        component: view('teachers/add/TeacherAddComponent'),
        meta: { title: 'Teachers Add' }
      }
    ]
  },
  {
    path: '/results',
    component: Layout,
    redirect: '/results/export',
    name: 'results',
    meta: { title: 'Results', icon: 'excel' },
    children: [
      {
        path: 'export',
        name: 'export',
        component: view('results/export/ResultsExportComponent'),
        meta: { title: 'Export Result' }
      },
      {
        path: 'upload',
        name: 'upload',
        component: view('results/upload/ResultsUploadComponent'),
        meta: { title: 'Upload Results' }
      }
    ]
  },
  {
    path: '/users',
    component: Layout,
    redirect: '/users/list',
    name: 'users',
    meta: { title: 'Users', icon: 'form' },
    children: [
      {
        path: 'list',
        name: 'list',
        component: view('users/list/UsersListComponent'),
        meta: { title: 'Users List' }
      },
      {
        path: 'add',
        name: 'add',
        component: view('users/add/UsersAddComponent'),
        meta: { title: 'Add Users' }
      }
    ]
  },

  // {
  //   path: '/form',
  //   component: Layout,
  //   children: [
  //     {
  //       path: 'index',
  //       name: 'Form',
  //       component: view('.views/form/index'),
  //       meta: { title: 'Form', icon: 'form' }
  //     }
  //   ]
  // },

  { path: '*', redirect: '/404', hidden: true }
]

export default new Router({
  scrollBehavior: () => ({ y: 0 }),
  // mode: 'history',
  routes: constantRouterMap
})

