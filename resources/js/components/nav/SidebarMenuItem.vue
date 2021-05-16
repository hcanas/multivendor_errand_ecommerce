<template>
    <router-link :to="to" :class="`${active} my-1`">
        <span class="flex items-center space-x-1">
            <i :class="`${icon} w-6 text-center text-amber-500`"></i>
            <span class="font-medium">{{ label }}</span>
            <span v-show="new_content" class="relative w-3 h-3 rounded-full -right-1">
                <span class="animate-ping absolute top-0.5 right-0.5 w-3 h-3 bg-red-700 rounded-full opacity-75"></span>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-700 rounded-full"></span>
            </span>
        </span>
    </router-link>
</template>

<script>
    export default {
        name: "SidebarMenuItem",
        props: {
            to: String,
            icon: String,
            label: String,
            is_active: Boolean,
            new_content: Boolean,
        },
        computed: {
            active() {
                return this.is_active ? 'active' : '';
            },
        },
    }
</script>

<style scoped>
    a:hover,
    a.active {
        @apply text-amber-500
    }
</style>
