require('./bootstrap');
import Vue from 'vue'
import router from './router';
import AppComponent from './components/app-component/AppComponent';

// import vueMaterial
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css' // themeing app

// tell vue to use material
Vue.use(VueMaterial)

// initialize the vue app
const app = new Vue({
  el: '#app',
  router,
  components: { AppComponent },
  template: '<AppComponent/>'
});
