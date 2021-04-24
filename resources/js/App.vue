<template>
    <router-view></router-view>
</template>

<script>
    export default {
        name: "App",
    }
</script>

<style scoped>
    ::-webkit-scrollbar {
        width: 5px;
    }

    ::-webkit-scrollbar-track {
        @apply bg-white
    }

    ::-webkit-scrollbar-thumb {
        @apply bg-red-600 rounded
    }

    ::-webkit-scrollbar-thumb:hover {
        @apply bg-red-600
    }
</style>
