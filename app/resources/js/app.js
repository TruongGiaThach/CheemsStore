require('./bootstrap');

window.Vue = require('vue');




import Vue from 'vue'
import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'
import Vuetify from "./plugins/vuetify"; //write this new line

Vue.use(VueRouter);
Vue.use(BootstrapVue)

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios,axios);

import router from './router'

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      if (localStorage.getItem("bigStore.jwt") == null) {
        next({ name: 'login' })
      } else {
        next() // go to wherever I'm going
      }
    } else {
      next() // does not require auth, make sure to always call next()!
    }
  })

/*import Login from './components/Login.vue'
import Register from './components/Register.vue'
import Admin from './components/Admin.vue'
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/admin/:page',
            name: 'admin-pages',
            component: Admin,
            meta: {
                requiresAuth: true,
                role: 'admin'
            }
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            meta: {
                requiresAuth: true,
                role: 'admin'
            }
        }
    ],
   
})

*/

export const eventBus = new Vue();

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router,
});