import axios from "../../axios.js"
export default {
    namespaced: true,

    state: () => ({
        isLogin: false,
        isLoadingProfile: false,
        profile: {}
    }), 
    actions: {
        hasRole({state}, rolename) { 

            return state.profile.role == rolename
        },
        login({commit}, formData) {
            return axios.post("login", formData).then( data=> {
                commit("SET_LOGIN", data.data)
            })
        },
        getProfile({commit, state}, data) {
            state.isLoadingProfile = true
            return axios.get("me").then( data=> {
                
                commit("SET_USER_PROFILE", data.data)
                state.isLoadingProfile = false
            })
        },
        updateProfile({commit, state}, formData) {
            state.isLoadingProfile = true
            return axios.post("me/update?_method=put", formData).then( data=> {
                commit("SET_USER_PROFILE", data.data.data)
                state.isLoadingProfile = false
            })
        },
        logout({state}){
            state.isLogin=false
            localStorage.removeItem('access_token')
            state.profile = {}
            axios.defaults.headers.common['Authorization'] = `Bearer `;
        }
    },
    mutations: {
        SET_LOGIN(state, data) {
            state.isLogin = true
            axios.defaults.headers.common['Authorization'] = `Bearer ${data.token}`;
            localStorage.setItem("access_token", data.token)
        },
        SET_USER_PROFILE(state, data) {
            state.isLogin = true
            state.profile = data
        }
    },
}