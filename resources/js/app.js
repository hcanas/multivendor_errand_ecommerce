require('./bootstrap');

import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import VueGapi from "vue-gapi";

createApp(App)
    .use(store)
    .use(router)
    .use(VueGapi, {
        apiKey: 'AIzaSyDgtqa8gkSmn7yuC6fI8DYyqf6bkRQvp6Y',
        clientId: '565068429643-v0lcrhhhm0d530f1j7nnm5eapfchipap.apps.googleusercontent.com',
        discoveryDocs: ['https://www.googleapis.com/discovery/v1/apis/drive/v3/rest'],
        scope: 'openid',
    })
    .mount('#app');
