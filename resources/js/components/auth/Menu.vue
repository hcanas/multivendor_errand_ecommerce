<template>
    <div class="w-full h-full">
        <p class="text-xl font-medium">{{ authUser.name }}</p>
        <p class="italic">{{ authUser.email }}</p>
        <p class="flex space-x-2">
            <span v-for="role in authUser.roles" :key="role" class="text-xs text-white bg-amber-500 font-medium uppercase px-2 py-0.5 rounded-full">
                {{ role }}
            </span>
        </p>

        <div class="flex flex-col mt-4">
            <sidebar-menu-item :to="``" @click.prevent="redirect(`/user/${authUser.id}/activity_log?page=1&per_page=15`)" :icon="`fas fa-portrait`" :label="`Profile`" :is_active="activeUserPage === 'profile'"></sidebar-menu-item>
            <sidebar-menu-item :to="``" @click.prevent="redirect(`/tickets`)" :icon="`fas fa-ticket-alt`" :label="`Tickets`" :is_active="activeUserPage === 'tickets'"></sidebar-menu-item>
            <sidebar-menu-item :to="``" @click.prevent="redirect(`/messages`)" :icon="`fas fa-comments`" :label="`Messages`" :is_active="activeUserPage === 'messages'"></sidebar-menu-item>
            <sidebar-menu-item :to="``" @click.prevent="redirect(`/notifications`)" :icon="`fas fa-bell`" :label="`Notifications`" :is_active="activeUserPage === 'notifications'"></sidebar-menu-item>
            <sidebar-menu-item :to="``" @click.prevent="redirect(`/settings`)" :icon="`fas fa-cogs`" :label="`Settings`" :is_active="activeUserPage === 'settings'"></sidebar-menu-item>
            <sidebar-menu-item :to="``" @click.prevent="logout()" :icon="`fas fa-sign-out-alt`" :label="`Logout`"></sidebar-menu-item>
        </div>
    </div>
</template>

<script>
    import SidebarMenuItem from "../nav/SidebarMenuItem";

    export default {
        name: "Menu",
        components: {
            SidebarMenuItem,
        },
        methods: {
            redirect(path) {
                this.$router.push(path);
                this.$emit('redirect');
            },
            logout() {
                this.$store.dispatch('auth/setToken', null);
                this.$store.dispatch('auth/setUser', null);
                this.$emit('loggedOut');
            },
        },
        computed: {
            authUser() {
                return this.$store.getters['auth/getUser'];
            },
            activeUserPage() {
                return this.$store.getters['navigation/getActiveUserPage'];
            },
        },
    }
</script>

<style scoped>

</style>
