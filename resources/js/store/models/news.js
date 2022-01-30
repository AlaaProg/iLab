import axios from "../../axios.js"
export default {
    namespaced: true,

    state: () => ({
        dataNews: []
    }), 
    getters: {
        news(state) {
            return state.dataNews
        }
    },
    actions: {
        get({commit}, args) {
            return axios.get(`news?search=${args.search}&page=${args.page}`)
                    .then( data=>{
                        commit("SET_DATA_NEWS", data.data)
                        return data
                    })
        }
    },
    mutations: {
        SET_DATA_NEWS(state, news){
            state.dataNews = news
        }
    },
}