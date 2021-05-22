<template>
    <a v-if="is_static" href="#" @click.prevent :class="active" v-html="label"></a>
    <router-link v-else :to="to" :class="active" v-html="label"></router-link>
</template>

<script>
    export default {
        name: "PaginationItem",
        props: {
            to: String,
            icon: String,
            label: String,
            is_active: Boolean,
            is_static: Boolean,
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
        @apply text-red-700
    }

    a:hover,
    a.active {
        @apply text-red-600 border-b border-red-600
    }
</style>
