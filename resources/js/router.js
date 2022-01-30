import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'

Vue.use(VueRouter)

const routes = [
    {
        name: "home",
        path: "",
        component: ()=> import("./views/Home.vue")
        
    },
    {
        name: "panel",
        path: "/admin",
        component: ()=> import("./views/panel/Panel.vue"),
        meta:{
            requiresAuth: true,
            roleAccess : 'admin'
        },
        children: [
            {
                name: 'dashboard',
                path: "",
                component: ()=> import("./views/panel/Dashboard.vue"),
            },
            {
                name: 'users',
                path: "users",
                component: ()=> import("./views/panel/User.vue"),
            },
            {
                name: 'news',
                path: "news",
                component: ()=> import("./views/panel/News.vue"),
            },
            {
                name: 'checkup',
                path: "checkup",
                component: ()=> import("./views/panel/Checkup.vue"),
            }
        ],
    },
    {
        name: "lab",
        path: "/lab",
        component: ()=> import("./views/panel/Lab.vue"),
        meta:{
            requiresAuth: true,
            roleAccess : 'lab'
        },
        children: [
            {
                name: 'checkup',
                path: "",
                component: ()=> import("./views/panel/Checkup.vue"),
            }
        ],
    },
    {
        name: "profile",
        path: "/me",
        component: ()=> import("./views/Profile.vue"),
        meta:{
            requiresAuth: true
        }
    },
    {
        name: "checkup",
        path: "/checkup",
        component: ()=> import("./views/CheckUp.vue"),
        meta:{
            requiresAuth: true,
            roleAccess : 'sick'
        }
    },
    {
        name: "login",
        path: "/login",
        component: ()=> import("./views/Login.vue"),
        meta: {
            guest: true
        }
    }
]



const router = new VueRouter({
    mode: 'history',
    routes
})

export default router;