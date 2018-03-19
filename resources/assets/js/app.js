require('./bootstrap');
import Vue from 'vue'
import router from './router';
import AppComponent from './components/app-component/AppComponent';

// Import Helpers for filters
import { domain, count, prettyDate, pluralize } from './filters'

// import vueMaterial
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css' // themeing app

// Import Install and register helper items
Vue.filter('count', count)
Vue.filter('domain', domain)
Vue.filter('prettyDate', prettyDate)
Vue.filter('pluralize', pluralize)

// tell vue to use material
Vue.use(VueMaterial)

// initialize the vue app
const app = new Vue({
  el: '#app',
  router,
  components: { AppComponent },
  template: '<AppComponent/>'
});
