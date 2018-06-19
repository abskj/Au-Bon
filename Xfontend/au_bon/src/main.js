import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router';

import Main from './components/main.vue';
import New_dashboard from './components/dashboard2.vue';
Vue.use(VueRouter);
const routes = [
  { path: '', component: Main},
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
