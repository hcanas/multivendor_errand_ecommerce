<template>
    <div class="w-full h-full">
        <div class="w-full h-full flex flex-col">
            <div class="flex-shrink-0 lg:w-1/3 order-1 bg-gray-50 h-20 lg:h-24">
                <router-link to="/" :class="`focus:outline-none`">
                    <img src="/images/logo.png" alt="brand logo" class="h-16 mx-auto lg:ml-8 my-2 lg:my-4">
                </router-link>
            </div>
            <div class="flex-shrink-0 order-3 lg:order-2 lg:w-2/3 lg:absolute lg:top-0 lg:right-0 bg-gray-50 h-14 lg:h-24">
                <div class="w-full h-full flex justify-evenly lg:justify-end items-center lg:space-x-8 lg:pr-8">
                    <navbar-item :to="``" :icon="`fas fa-home`" :label="`HOME`" :is_active="activePage === 'home'" @click="redirect('/')"></navbar-item>
                    <navbar-item :to="``" :icon="`fas fa-shopping-basket`" :label="`SHOP`" :is_active="activePage === 'shop'" @click="redirect('shop')"></navbar-item>
                    <navbar-item :to="``" :icon="`fas fa-store`" :label="`STORES`" :is_active="activePage === 'stores'" @click="redirect('stores')"></navbar-item>
                    <navbar-item :to="``" :icon="`fas fa-shopping-cart`" :label="`CART`" :is_active="activePage === 'cart'" :new_content="false" @click="redirect('cart')"></navbar-item>
                    <navbar-item v-if="user_menu.show" :to="``" :icon="`fas fa-times`" :label="`CLOSE`" :is_active="false" :new_content="false" @click="user_menu.show = false"></navbar-item>
                    <navbar-item v-if="user_menu.show === false && authToken === null" :to="``" :icon="`fas fa-sign-in-alt`" :label="`LOGIN`" :is_active="false" :new_content="false" @click="user_menu.show = true"></navbar-item>
                    <navbar-item v-if="user_menu.show === false && authToken" :to="``" :icon="`fas fa-user`" :label="`USER`" :is_active="false" :new_content="false" @click="user_menu.show = true"></navbar-item>
                </div>
            </div>
            <div class="flex-grow order-2 lg:order-3 bg-white overflow-hidden relative">
                <div id="content" :class="{ 'pull-left': user_menu.show }" class="w-full h-full p-4 lg:p-8 overflow-y-scroll transition transform">
                    <router-view :key="$route.path"></router-view>
                </div>
                <div id="user_menu" :class="{ show: user_menu.show }" class="w-full lg:w-80 h-full bg-gray-50 absolute top-0 right-0 p-4 lg:p-8 overflow-y-scroll transition transform translate-x-full">
                    <component
                        @login="user_menu.component = 'login'"
                        @logged-in="fetchAuthUser()"
                        @logged-out="completeLogout()"
                        @create-account="user_menu.component = 'registration'"
                        @forgot-password="user_menu.component = 'recovery'"
                        @redirect="user_menu.show = false"
                        :is="user_menu.component">
                    </component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import NavbarItem from "./components/nav/NavbarItem";
    import Login from "./components/auth/Login";
    import Registration from "./components/auth/Registration";
    import Recovery from "./components/auth/Recovery";
    import UserMenu from "./components/auth/Menu";

    import Echo from "laravel-echo";
    import Pusher from "pusher-js";

    export default {
        name: "App",
        created() {
            if (this.authToken) {
                this.fetchAuthUser();
            }
        },
        data() {
            return {
                user_menu: {
                    show: false,
                    component: 'login',
                },
                pop_up: {
                    show: false,
                    message: '',
                },
                echo: null,
            }
        },
        components: {
            NavbarItem,
            Login,
            Registration,
            Recovery,
            UserMenu,
        },
        methods: {
            redirect(path) {
                this.$router.push(path);
                this.user_menu.show = false;
            },
            completeLogout() {
                if (this.echo) {
                    this.echo.connector.disconnect();
                }

                this.user_menu.component = 'login';
            },
            fetchAuthUser() {
                axios.get('/api/auth/user', {
                        headers: {
                            Authorization: 'Bearer ' + this.authToken,
                        },
                    })
                    .then(response => {
                        this.$store.dispatch('auth/setUser', response.data);
                        this.user_menu.component = 'user-menu';
                        this.checkUserUpdates();
                    })
                    .catch(error => {
                        console.log(error);
                        this.$store.dispatch('auth/setToken', null);
                        this.user_menu.component = 'login';
                    });
            },
            checkUserUpdates() {
                this.echo = new Echo({
                    broadcaster: 'pusher',
                    key: 'local',
                    wsHost: window.location.hostname,
                    wsPort: 6001,
                    forceTLS: false,
                    disableStats: true,
                });

                this.echo.private(`auth.${this.authUser.id}`)
                    .listen('UserNameUpdated', (e) => {
                        this.$store.dispatch('auth/setUser', {
                            ...this.authUser,
                            name: e.new_name,
                        });
                    });

                axios.get('/api/auth/notifications', {
                        headers: {
                            Authorization: 'Bearer ' + this.authToken,
                        },
                    })
                    .then(response => {
                        this.$store.dispatch('auth/setNotifications', response.data);
                    })
                    .catch(error => {});

                this.echo.private(`App.Models.User.${this.authUser.id}`)
                    .notification((notification) => {
                        console.log(notification);
                    });
            },
        },
        computed: {
            activePage() {
                return this.$store.getters['navigation/getActivePage'];
            },
            authToken() {
                return this.$store.getters['auth/getToken'];
            },
            authUser() {
                return this.$store.getters['auth/getUser'];
            },
        },
    }
</script>

<style scoped>
    div::-webkit-scrollbar {
        @apply w-1.5 h-full
    }

    div::-webkit-scrollbar-thumb {
        @apply bg-red-700 rounded-full
    }

    div::-webkit-scrollbar-thumb:hover {
        @apply bg-red-600
    }

    #user_menu.show {
        @apply translate-x-0
    }

    #content.pull-left {
        @apply -translate-x-80
    }
</style>
