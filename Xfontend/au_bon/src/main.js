import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router';

import Login from './components/login.vue';
import Dashboard from './components/dashboard.vue';
import New_dashboard from './components/dashboard2.vue';
Vue.use(VueRouter);
const routes = [
  { path: '', component: Login},
  { path: '/dashboard_old', component: Dashboard},
  { path: '/dashboard', component: New_dashboard},
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
