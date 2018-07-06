import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router';

import Main from './components/main.vue';
import New_dashboard from './components/dashboard2.vue';
import create_user from './components/addUser.vue';
import Transaction from './components/dashboard_components/transaction.vue';
import RestroAdd from './components/dashboard_components/add_restro.vue';
import MangAdd from './components/dashboard_components/add_manager.vue';
import BranchAdd from './components/dashboard_components/add_branch.vue';
import CatAdd from './components/dashboard_components/add_cat.vue';
import ItemAdd from './components/dashboard_components/add_items.vue';
Vue.use(VueRouter);
Vue.use(VueRouter);
const routes = [
  { path: '', component: Main,
  children:[
    {path: '', component: Transaction},
    {path: '/restro-add', component: RestroAdd},
    { path: '/manager-add/', component: MangAdd,},
    { path: '/branch-add/', component: BranchAdd,},
    { path: '/cat-add/', component: CatAdd,},
    { path: '/item-add/', component: ItemAdd,},
  ]
},
  { path: '/dashboard', component: New_dashboard},
  { path: '/create-admin', component: create_user},
 
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
