<template>
    <button type="button" class="text-white font-medium bg-red-700 hover:bg-red-600 p-1.5 rounded focus:outline-none focus:bg-red-600">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        name: "Primary",
    }
</script>

<style scoped>

</style>
