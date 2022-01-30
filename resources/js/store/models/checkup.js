import axios from "../../axios.js"
export default {
    namespaced: true,

    state: () => ({
        data: [],
        current: {lab: {},sick: {},}
    }), 
    getters: {},
    actions: {
        getUsers(){
            
            return axios.get(`panel/user?per_page=10000`)
        },
        all({commit}, data) {
            return axios.get(`panel/checkup?search=${data.search}&page=${data.page}`)
                    .then( data=>{
                        commit("SET_DATA", data.data)
                        return data
                    })
        },
        get({commit}, id) {
            return axios.get(`panel/checkup/${id}`)
                .then( data=>{
                    commit("SET_CURRENT", data.data.data)
                    return data
                })
        },
        update({commit}, data) {
            return axios.post(`panel/checkup/${data.id}?_method=put`, data.formData)
                .then( data=>{
                    commit("UPDATE", data.data)
                })
        },
        create({commit}, formData) {
            return axios.post(`panel/checkup`, formData)
                .then( data=>{

                    commit("CREATE_NEW", data.data)
                })
        },
        delete({commit}, checkup) {
            return axios.delete(`panel/checkup/${checkup.id}`)
                .then( data=>{
                    commit("DELETE", checkup)
                })
        },
    },
    mutations: {
        SET_DATA(state, data){
            state.data = data
        },
        SET_CURRENT(state, data) {
            state.current = data
        },
        DELETE(state, data) {
            state.data.data = state.data.data.filter((checkup)=>{
                return checkup.id != data.id
            })
        },
        UPDATE(state, {data}) {
            state.data.data = state.data.data.map((checkup)=>{
                return (checkup.id == data.id) ? data : checkup
            })
        },
        CREATE_NEW(state, data) {
            state.data.data.push(data.data)
        },
    },
}