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
        setActivePage(state, page) {
            state.active_page = page;
        },
        setActiveUserPage(state, page) {
            state.active_user_page = page;
        },
        setActiveProfilePage(state, page) {
            state.active_profile_page = page;
        },
    },
    actions: {
        setActivePage({ commit }, page) {
            commit('setActivePage', page);
        },
        setActiveUserPage({ commit }, page) {
            commit('setActiveUserPage', page);
        },
        setActiveProfilePage({ commit }, page) {
            commit('setActiveProfilePage', page);
        },
    },
};

export default navigation;
