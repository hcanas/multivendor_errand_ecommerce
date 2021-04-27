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
                <div id="user_menu" :class="showUserMenu" class="w-full lg:w-96 h-full bg-gray-100 absolute top-0 right-0 p-4 lg:p-8 overflow-y-scroll transition duration-200 transform translate-x-full">
                    <div>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pellentesque justo sit amet orci gravida dictum. Nulla fringilla pulvinar vulputate. Ut efficitur, metus ut interdum rutrum, justo elit iaculis diam, fermentum suscipit lorem turpis vitae nisl. Donec commodo libero in arcu ullamcorper consequat. In purus lacus, mattis ut consequat egestas, commodo at urna. Aenean ultricies tempus aliquet. Aliquam dictum vulputate cursus. Fusce porta velit eget elit ultrices, vitae pretium dui finibus. In efficitur tellus metus, eget scelerisque lorem mollis non. Morbi quis quam eu dolor malesuada pulvinar. Aenean sit amet ante mauris. Aliquam consectetur accumsan felis a auctor. Nulla rhoncus massa tortor, consectetur suscipit metus eleifend vel.

                        Curabitur ac tempus libero, fringilla commodo nisi. Donec ac est eget magna euismod ultrices. Ut sollicitudin quam vel pulvinar porttitor. Mauris felis nisl, commodo vitae lacinia in, molestie nec urna. Ut et metus nec ligula ullamcorper malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut scelerisque mollis mauris, eu blandit metus ullamcorper nec. Aliquam molestie cursus ex, ac lacinia ipsum pretium in. Duis volutpat magna ac lectus auctor, et ultricies odio faucibus. Donec aliquet tristique purus ultrices varius. Suspendisse sagittis sagittis libero sed ultrices.

                        Mauris convallis lacus ante, nec tincidunt ligula mattis ut. Etiam magna odio, tempor ut mi ac, sollicitudin rutrum metus. Fusce at auctor sem, et laoreet tortor. Quisque maximus hendrerit placerat. Duis iaculis rutrum mauris, eu suscipit turpis sagittis at. Aenean eu orci at turpis congue placerat. Integer ultrices massa a tempus pharetra. Nam faucibus odio sapien, quis efficitur quam accumsan a. Vivamus et magna viverra, placerat lacus ac, vestibulum risus. Nunc arcu purus, fringilla at pellentesque non, facilisis id turpis. Cras laoreet accumsan ante, in euismod orci faucibus ut. Ut sed sodales magna, eget euismod purus. Sed nec molestie odio, eget pellentesque augue. Nam eget viverra est.

                        Duis varius dolor felis, at consectetur felis iaculis finibus. Suspendisse interdum gravida leo, ut ornare lorem congue at. Phasellus aliquam consequat varius. Phasellus eu dignissim enim. Vestibulum nec bibendum nunc, vel porta magna. Cras tincidunt lacus sed iaculis dictum. Maecenas sagittis dui nec justo fringilla, at posuere velit semper. Aliquam erat volutpat. Mauris id vehicula libero.

                        Proin egestas, erat non posuere semper, nisi massa mollis tellus, id luctus risus tellus eu magna. Pellentesque elementum iaculis sapien ac rutrum. Pellentesque varius augue non accumsan laoreet. Morbi sit amet scelerisque ex, eu viverra ipsum. Nullam nec lorem at augue tincidunt interdum vulputate vestibulum quam. Aliquam et facilisis enim. Donec egestas ipsum convallis iaculis maximus. Aenean auctor arcu eros, in gravida justo tempus id.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import NavbarItem from "./components/nav/NavbarItem";

    export default {
        name: "App",
        data() {
            return {
                user_menu: {
                    show: false,
                },
            }
        },
        components: {
            NavbarItem,
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
