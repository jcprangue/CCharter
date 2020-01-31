import Vue from 'vue'
import Vuex from 'vuex'


Vue.use(Vuex);
const store = new Vuex.Store({

    state: {
        ACTIVE_URL: '',
        ACTIVE_OFFICE: 0,
    },
    mutations: {
        setActiveOffice : function(state, n)
        {
            state.ACTIVE_OFFICE = n;
        }
    },
    actions: {

    },
    getters: {

    }
})

export default store;