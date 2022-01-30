import axios from "../../axios.js"
export default {
    namespaced: true,

    state: () => ({
        data: {},
        current: {}
    }), 
    getters: {},
    actions: {
        all({commit}, data) {
            return axios.get(`panel/news?search=${data.search}&page=${data.page}`)
                    .then( data=>{
                        commit("SET_DATA_NEWS", data.data)
                        return data
                    })
        },
        get({commit}, id) {
            return axios.get(`panel/news/${id}`)
                .then( data=>{
                    commit("SET_CURRENT_NEWS", data.data.data)
                    return data
                })
        },
        update({commit}, data) {
            return axios.post(`panel/news/${data.id}?_method=put`, data.formData)
                .then( data=>{
                    console.log(data)
                    commit("UPDATE_NEWS", data.data)
                })
        },
        create({commit}, formData) {
            return axios.post(`panel/news`, formData)
                .then( data=>{
                    console.log(data)
                    commit("CREATE_NEW_NEWS", data.data)
                })
        },
        delete({commit}, news) {
            return axios.delete(`panel/news/${news.id}`)
                .then( ()=>{
                    commit("DELETE_NEWS", news)
                })
        },
    },
    mutations: {
        SET_DATA_NEWS(state, data){
            state.data = data
        },
        SET_CURRENT_NEWS(state, data) {
            state.current = data
        },
        DELETE_NEWS(state, data) {
            state.data.data = state.data.data.filter((news)=>{
                return news.id != data.id
            })
        },
        UPDATE_NEWS(state, {data}) {
            state.data.data = state.data.data.map((news)=>{
                return (news.id == data.id) ? data : news
            })
        },
        CREATE_NEW_NEWS(state, data) {
            state.data.data.unshift(data.data)
        },
    },
}