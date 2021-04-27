const navigation = {
    namespaced: true,
    state: {
        active_page: '',
        active_user_page: '',
        active_profile_page: '',
    },
    getters: {
        getActivePage(state) {
            return state.active_page;
        },
        getActiveUserPage(state) {
            return state.active_user_page;
        },
        getActiveProfilePage(state) {
            return state.active_profile_page;
        },
    },
    mutations: {
        setActivePage(state, payload) {
            state.active_page = payload.value;
        },
        setActiveUserPage(state, payload) {
            state.active_user_page = payload.value;
        },
        setActiveProfilePage(state, payload) {
            state.active_profile_page = payload.value;
        },
    },
    actions: {
        setActivePage({ commit }, payload) {
            commit('setActivePage', payload);
        },
        setActiveUserPage({ commit }, payload) {
            commit('setActiveUserPage', payload);
        },
        setActiveProfilePage({ commit }, payload) {
            commit('setActiveProfilePage', payload);
        },
    },
};

export default navigation;
