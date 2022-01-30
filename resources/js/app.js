require('./bootstrap');

import moment from 'moment'
import Vue from "vue"
import router from "./router"
import store from "./store"
import App from "./App.vue"

Vue.filter('moment', (value) => {
    return moment(value).format('MMMM Do YYYY');
})

// Meta Handling
router.beforeEach((to, from, next) => {
    let auth = store.state.auth 
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!auth.isLogin) {
            next({
                name: 'login',
                params: { nextUrl: to.fullPath }
            })
        } else {

            if (to.matched.some(record => record.meta.roleAccess)) {
                let isRoleAccess = to.matched.some(record => {
                    return record.meta.roleAccess == auth.profile.role
                })
                if (isRoleAccess) {
                    next()
                } else {
                    next({name: "login"})
                }
            } else {
                next()
            }
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (!auth.isLogin) {
            next()
        } else {
            next({ name: 'home' })
        }
    } else {
        next()
    }
})

store.dispatch("auth/getProfile")
    .finally(()=>{
        const app = new Vue({
            el: '#app',
            router,
            store,
            render: (h) => h(App)
        });
    })
