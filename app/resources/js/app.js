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

import App from './components/App'
//Vue.component('App', require('./components/App.vue').default);
import Home from './components/Home'
import Login from './components/Login'
import Register from './components/Register'
import SingleProduct from './components/SingleProduct'
import Checkout from './components/Checkout'
import Confirmation from './components/Confirmation'
import UserBoard from './components/UserBoard'
import Admin from './components/Admin'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/',
            name: 'home_or',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/products/:id',
            name: 'single-products',
            component: SingleProduct
        },
        {
            path: '/statistic/:id',
            name: 'single-products',
            component: SingleProduct
        },
        {
            path: '/confirmation',
            name: 'confirmation',
            component: Confirmation
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: Checkout,
            props: (route) => ({ pid: route.query.pid })
        },
        {
            path: '/dashboard',
            name: 'userboard',
            component: UserBoard,
            meta: {
                requiresAuth: true,
                role: 'user'
            }
        },
        {
            path: '/admin/:page',
            name: 'admin-pages',
            component: Admin,
            meta: {
                //requiresAuth: true,
                role: 'admin'
            }
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            meta: {
                //requiresAuth: true,
                role: 'admin'
            }
        },
    ],
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage.getItem('bigStore.jwt') == null) {
            next({
                path: '/login',
                params: { nextUrl: to.fullPath }
            })
        } else {
            let user = JSON.parse(localStorage.getItem('bigStore.user'))
            if (to.matched.some(record => record.meta.is_admin)) {
                if (user.is_admin == 1) {
                    next()
                }
                else {
                    next({ name: 'userboard' })
                }
            }
            else if (to.matched.some(record => record.meta.is_user)) {
                if (user.is_admin == 0) {
                    next()
                }
                else {
                    next({ name: 'admin' })
                }
            }
            next()
        }
    } else {
        next()
    }
})
const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    components: { App },
    router,
});