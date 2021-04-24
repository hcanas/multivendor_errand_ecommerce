import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import * as Cookies from "js-cookie";

const store = createStore({
    modules: {},
    plugins: [
        createPersistedState({
            storage: {
                getItem: (key) => Cookies.get(key),
                setItem: (key, value) => Cookies.set(key, value, { expires: 1/3, secure: true }),
                removeItem: (key) => Cookies.remove(key),
            },
        }),
    ],
});

export default store;
