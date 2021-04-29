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
                    <navbar-item v-else :to="``" :icon="`fas fa-sign-in-alt`" :label="`LOGIN`" :is_active="false" :new_content="false" @click="user_menu.show = true"></navbar-item>
                </div>
            </div>
            <div class="flex-grow order-2 lg:order-3 bg-white overflow-hidden relative">
                <div class="w-full h-full p-4 lg:p-8 overflow-y-scroll" style="direction: rtl">
                    <div style="direction: ltr">
                        <router-view :key="$route.path"></router-view>
                    </div>
                </div>
                <div id="user_menu" :class="showUserMenu" class="w-full lg:w-96 h-full bg-gray-50 absolute top-0 right-0 p-4 lg:p-8 overflow-y-scroll transition duration-200 transform translate-x-full">
                    <component
                        @login="user_menu.component = 'login'"
                        @create-account="user_menu.component = 'registration'"
                        @forgot-password="user_menu.component = 'recovery'"
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

    export default {
        name: "App",
        data() {
            return {
                user_menu: {
                    show: false,
                    component: 'login',
                },
            }
        },
        components: {
            NavbarItem,
            Login,
            Registration,
            Recovery,
        },
        methods: {
            redirect(path) {
                this.$router.push(path);
                this.user_menu.show = false;
            },
        },
        computed: {
            activePage() {
                return this.$store.getters['navigation/getActivePage'];
            },
            showUserMenu() {
                return this.user_menu.show ? 'show' : '';
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
</style>
