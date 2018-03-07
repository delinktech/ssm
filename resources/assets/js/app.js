require('./bootstrap');
/*import Vue from 'vue';
import VueMaterial from 'vue-material';

Vue.use(VueMaterial);*/

Vue.component(
  'app-component',
  require('./components/AppComponent.vue')
);

const app = new Vue({
  el: '#app'
});
