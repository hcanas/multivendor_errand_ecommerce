const auth = {
    namespaced: true,
    state: {
        token: null,
        user: null,
        notifications: null,
    },
    getters: {
        getToken(state) {
            return state.token;
        },
        getUser(state) {
            return state.user;
        },
        getNotifications(state) {
            return state.notifications;
        },
    },
    mutations: {
        setToken(state, token) {
            state.token = token;
        },
        setUser(state, user) {
            state.user = user;
        },
        setNotifications(state, notifications) {
            state.notifications = notifications;
        },
    },
    actions: {
        setToken({ commit }, token) {
            commit('setToken', token);
        },
        setUser({ commit }, user) {
            commit('setUser', user);
        },
        setNotifications({ commit }, notifications) {
            commit('setNotifications', notifications);
        },
    },
};

export default auth;
