<template>
    <router-link class="text-red-700 hover:text-red-600 border-b border-white hover:border-red-600 focus:outline-none focus:text-red-600 focus:border-red-600">
        <slot></slot>
    </router-link>
</template>

<script>
    export default {
        name: "Primary",
    }
</script>

<style scoped>

</style>
