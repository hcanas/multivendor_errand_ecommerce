<template>
    <a v-if="is_static" href="#" @click.prevent :class="active">
        <div class="flex flex-col items-center space-x-1 rounded-l py-2 relative">
            <i :class="`${icon} text-xl w-6 lg:w-11 text-center`"></i>
            <span class="hidden lg:inline text-xs">{{ label }}</span>
            <span v-show="new_content" class="absolute w-3 h-3 rounded-full -top-1.5 -right-1.5">
                <span class="animate-ping absolute top-0.5 right-0.5 w-3 h-3 bg-red-700 rounded-full opacity-75"></span>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-700 rounded-full"></span>
            </span>
        </div>
    </a>
    <router-link v-else :to="to" :class="active">
        <div class="flex flex-col items-center space-x-1 rounded-l py-2 relative">
            <i :class="`${icon} text-xl w-6 lg:w-11 text-center`"></i>
            <span class="hidden lg:inline text-xs">{{ label }}</span>
            <span v-show="new_content" class="absolute w-3 h-3 rounded-full -top-1.5 -right-1.5">
                <span class="animate-ping absolute top-0.5 right-0.5 w-3 h-3 bg-red-700 rounded-full opacity-75"></span>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-700 rounded-full"></span>
            </span>
        </div>
    </router-link>
</template>

<script>
    export default {
        name: "NavbarItem",
        props: {
            to: String,
            icon: String,
            label: String,
            is_active: Boolean,
            is_static: Boolean,
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
    a {
        @apply font-bold hover:text-red-700 focus:text-red-700 focus:outline-none transition duration-200
    }

    a.active {
        @apply text-red-700
    }

    a > div {
       @apply flex flex-col items-center space-x-1 rounded-l py-2 relative
    }
</style>
