import { createRouter,createWebHistory } from "vue-router"
import store from './store'
import home from './pages/home.vue'
import login from './pages/login.vue'
import register from './pages/register.vue'
import dashboard from './pages/dashboard.vue'

const routes = [
    {
        path:'/',
        name:'home',
        component:home
    },
    {
        path:'/login',
        name:'login',
        component:login,
        meta:{
            requiresAuth:false
        }
    },
    {
        path:'/register',
        name:'register',
        component:register,
        meta:{
            requiresAuth:false
        }
    },
    {
        path:'/dashboard',
        name:'dashboard',
        component:dashboard,
        meta:{
            requiresAuth:true
        }
    },
]


const router = createRouter({
    history:createWebHistory(),
    routes
})

router.beforeEach((to,form) =>{
    if(to.meta.requiresAuth && store.getters.getToken == 0){
        return {name:'login'}
    }
    if(to.meta.requiresAuth == false && store.getters.getToken != 0 ){
        return {name:'dashboard'}
    }
})

export default router
