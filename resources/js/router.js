import {createRouter, createWebHistory} from "vue-router"
import {useUserAuth} from "@/store/useUserAuth.js"

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: () => import('@/pages/Home.vue'),
            name: 'home'
        },
        {
            path: '/history',
            component: () => import('@/pages/History.vue'),
            name: 'history'
        },
        {
            path: '/login',
            component: () => import('@/pages/Auth/Login.vue'),
            name: 'login'
        },
    ]
})

router.beforeEach((to, from, next) => {
    const {isAuthorized} = useUserAuth()

    if (!isAuthorized) {
        if (['login'].includes(to.name)) {
            return next()
        } else {
            return next({name: 'login'})
        }
    } else {
        if (['login'].includes(to.name)) {
            return next({name: 'home'})
        }
    }
    next()
})

export default router
