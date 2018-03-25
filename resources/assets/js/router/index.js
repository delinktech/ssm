import Vue from 'vue'
import Router from 'vue-router'
import axios from 'axios'

// in development-env not use lazy-loading, because lazy-loading too many pages will cause webpack hot update too slow. so only in production use lazy-loading;
// detail: https://panjiachen.github.io/vue-element-admin-site/#/lazy-loading

axios.defaults.baseURL = 'http://dev.ssm.io/api'

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

  // {
  //   path: '/students',
  //   component: Layout,
  //   redirect: '/students/list',
  //   name: 'Students',
  //   meta: { title: 'Students', icon: 'list' },
  //   children: [
  //     {
  //       path: 'list',
  //       name: 'StudentsList',
  //       component: view('.views/students/students-list'),
  //       meta: { title: 'Students List', icon: 'table' }
  //     },
  //     {
  //       path: 'add',
  //       name: 'StudentAdd',
  //       component: view('.views/students/students-add'),
  //       meta: { title: 'Students Add', icon: 'form' }
  //     }
  //   ]
  // },

  // {
  //   path: '/teachers',
  //   component: Layout,
  //   redirect: '/teachers/list',
  //   name: 'Teachers',
  //   meta: { title: 'Teachers', icon: 'pen' },
  //   children: [
  //     {
  //       path: 'list',
  //       name: 'TeachersList',
  //       component: view('.views/teachers/teachers-list'),
  //       meta: { title: 'Teachers List', icon: 'table' }
  //     },
  //     {
  //       path: 'add',
  //       name: 'TeachersAdd',
  //       component: view('.views/teachers/teachers-add'),
  //       meta: { title: 'Teachers Add', icon: 'form' }
  //     }
  //   ]
  // },

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

