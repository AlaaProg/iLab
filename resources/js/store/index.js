import Vue from 'vue'
import Vuex from 'vuex'
import news from "./models/news"
import auth from "./models/auth"
import users from "./models/users"
import newses from "./models/newses"
import checkup from "./models/checkup"

Vue.use(Vuex)

const store = new Vuex.Store({

    modules: {
        news,
        auth,
        users,
        newses,
        checkup
    }
})


export default store;
