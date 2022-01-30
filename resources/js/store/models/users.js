import axios from "../../axios.js"
export default {
    namespaced: true,

    state: () => ({
        dataUsers: [],
        currentUser: {
            info:{}
        }
    }), 
    getters: {},
    actions: {
        all({commit}, data) {
            return axios.get(`panel/user?search=${data.search}&page=${data.page}&role=${data.role}`)
                    .then( data=>{
                        commit("SET_DATA_USERS", data.data)
                        return data
                    })
        },
        get({commit}, id) {
            return axios.get(`panel/user/${id}`)
                .then( data=>{
                    commit("SET_CURRENT_USER", data.data.data)
                    return data
                })
        },
        update({commit}, data) {
            return axios.post(`panel/user/${data.id}?_method=put`, data.formData)
                .then( data=>{
                    commit("UPDATE_USER", data.data)
                })
        },
        create({commit}, formData) {
            return axios.post(`panel/user`, formData)
                .then( data=>{
                    console.log(data)
                    commit("CREATE_NEW_USER", data.data)
                })
        },
        delete({commit}, user) {
            return axios.delete(`panel/user/${user.id}`)
                .then( data=>{
                    commit("DELETE_USER", user)
                })
        },
    },
    mutations: {
        SET_DATA_USERS(state, data){
            state.dataUsers = data
        },
        SET_CURRENT_USER(state, data) {
            state.currentUser = data
        },
        DELETE_USER(state, data) {
            state.dataUsers.data = state.dataUsers.data.filter((user)=>{
                return user.id != data.id
            })
        },
        UPDATE_USER(state, {data}) {
            state.dataUsers.data = state.dataUsers.data.map((user)=>{
                return (user.id == data.id) ? data : user
            })
        },
        CREATE_NEW_USER(state, data) {
            state.dataUsers.data.push(data.data)
        },
    },
}