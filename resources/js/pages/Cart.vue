<template>
    <div>Cart</div>
</template>

<script>
    export default {
        name: "Cart",
        created() {
            document.title = 'Cart';
            this.$store.dispatch('navigation/setActivePage', { value: 'cart' });
        },
    }
</script>

<style scoped>

</style>
