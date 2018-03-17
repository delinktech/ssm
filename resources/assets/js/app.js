require('./bootstrap');
/*import Vue from 'vue';
import VueMaterial from 'vue-material';

Vue.use(VueMaterial);*/

Vue.component(
  'school-component',
  require('./components/school.component/SchoolComponent.vue')
);

Vue.component(
  'result-component',
  require('./components/results.component/ResultsComponent.vue')
);

Vue.component(
  'teacher-component',
  require('./components/teachers.component/TeachersComponent.vue')
);

Vue.component(
  'student-component',
  require('./components/students.component/StudentsComponent.vue')
);

Vue.component(
  'app-component',
  require('./components/AppComponent.vue')
);

const app = new Vue({
  el: '#app'
});
