import Home from '../components/home/Home'
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