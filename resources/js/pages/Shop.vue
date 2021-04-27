<template>
    <div>Shop</div>
</template>

<script>
    export default {
        name: "Shop",
        created() {
            document.title = 'Shop';
            this.$store.dispatch('navigation/setActivePage', { value: 'shop' });
        },
    }
</script>

<style scoped>

</style>
