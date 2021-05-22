<template>
    <button type="button" class="text-white bg-red-700 hover:bg-red-600 px-2 py-1 rounded focus:outline-none focus:bg-red-600">
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
