import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router';

import Login from './components/login.vue';
import Dashboard from './components/dashboard.vue';
Vue.use(VueRouter);
const routes = [
  { path: '', component: Login},
  { path: '/dashboard', component: Dashboard}
];

const router = new VueRouter({
  mode: 'history',
  routes: routes
});


new Vue({
  el: '#app',
  router: router,
  render: h => h(App)
})
