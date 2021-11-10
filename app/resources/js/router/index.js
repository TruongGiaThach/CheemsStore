
import VueRouter from 'vue-router'
import routes from './routers'

const router = new VueRouter({
    routes,
    mode: 'history'
})

export default router