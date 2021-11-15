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


const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router,
});