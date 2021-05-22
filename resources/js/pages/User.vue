<template>
    <div class="w-full h-full">
        <div v-if="user" class="w-full h-full flex flex-col lg:flex-row lg:items-stretch">
            <div class="w-full lg:w-72 lg:flex-shrink-0 lg:px-4 flex flex-col items-center lg:items-start">
                <p class="text-xl font-medium">{{ user.name }}</p>
                <p class="italic">{{ user.email }}</p>
                <p class="flex flex-wrap space-x-2">
                    <span v-for="role in user.roles" :key="role" class="text-xs text-white bg-amber-500 font-medium uppercase px-2 py-0.5 rounded-full">
                        {{ role }}
                    </span>
                </p>

                <div class="w-full flex lg:flex-col justify-evenly lg:justify-center py-4">
                    <profile-menu-item :to="`/user/${$route.params.id}/activity_log?page=1&per_page=15`" :icon="`fas fa-chart-line`" :label="`Activity Log`" :is_active="activeProfilePage === 'activity_log'" :new_content="false"></profile-menu-item>
                    <profile-menu-item :to="`/user/${$route.params.id}/orders`" :icon="`fas fa-shopping-cart`" :label="`Orders`" :is_active="false" :new_content="false"></profile-menu-item>
                    <profile-menu-item :to="``" :icon="`fas fa-store`" :label="`Stores`" :is_active="false" :new_content="false"></profile-menu-item>
                    <profile-menu-item :to="``" :icon="`fas fa-motorcycle`" :label="`Deliveries`" :is_active="false" :new_content="false"></profile-menu-item>
                    <profile-menu-item :to="``" :icon="`fas fa-ticket-alt`" :label="`Tickets`" :is_active="false" :new_content="false"></profile-menu-item>
                    <profile-menu-item :to="``" :icon="`fas fa-cog`" :label="`Account Settings`" :is_active="false" :new_content="false"></profile-menu-item>
                </div>
            </div>
            <div class="w-full lg:flex-grow lg:px-4 mt-4 lg:mt-0">
                <router-view :key="$route.query"></router-view>
            </div>
        </div>
        <page-not-found v-show="show_404"></page-not-found>
    </div>
</template>

<script>
    import PageNotFound from "../components/errors/PageNotFound";
    import ProfileMenuItem from "../components/nav/ProfileMenuItem";

    export default {
        name: "User",
        components: {
            ProfileMenuItem,
            PageNotFound,
        },
        created() {
            axios.get(`/api/users/${this.$route.params.id}`, {
                    headers: {
                        Authorization: `Bearer ${this.$store.getters['auth/getToken']}`,
                    },
                })
                .then(response => {
                    this.user = response.data.data;
                })
                .catch(error => {
                    this.show_404 = true;
                });
        },
        data() {
            return {
                user: null,
                show_404: false,
            }
        },
        computed: {
            activeProfilePage() {
                return this.$store.getters['navigation/getActiveProfilePage'];
            },
        },
    }
</script>

<style scoped>

</style>
