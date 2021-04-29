<template>
    <router-link class="text-red-700 hover:text-red-600 hover:underline focus:outline-none focus:text-red-600 focus:underline">
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
