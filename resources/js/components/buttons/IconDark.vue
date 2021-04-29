<template>
    <button type="button" class="text-gray-700 font-medium p-1.5 rounded hover:text-gray-500 focus:outline-none focus:text-gray-500">
        <i :class="icon"></i>
    </button>
</template>

<script>
    export default {
        name: "IconDark",
        props: {
            icon: String,
        },
    }
</script>

<style scoped>

</style>
