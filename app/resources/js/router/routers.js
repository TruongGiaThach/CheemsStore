import Home from '../components/home/Home'
import Store from '../components/home/product_page/store'
import Product from '../components/home/product_page/product'
import Login from '../components/Login'
import Register from '../components/Register'
import Admin from '../components/Admin'

import Layout from '../components/home/HomePageLayout'
export default [
    {
        path: '/',
        redirect: '/home',
    },
    {
        path: '/home',
        name: 'layout',
        component: Layout,
        children :[
            {
                path: '/home',
                name: 'home',
                component: Home,
            },
            {
                path: '/register',
                name: 'register',
                component: Register
            },
            {
                path: '/store',
                redirect: '/store/all',
            },
            {
                path: '/store/:category',
                name: 'store',
                component: Store,
                props: true,
            },
            {
                path: '/store/:category/:search',
                name: 'searchStore',
                component: Store,
                props: true,
            },
            {
                path: '/product/:product',
                name: 'product',
                component: Product,
                props: true,
            },
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: Login
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
]