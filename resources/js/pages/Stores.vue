<template>
    <div>Stores</div>
</template>

<script>
    export default {
        name: "Stores",
        created() {
            document.title = 'Stores';
            this.$store.dispatch('navigation/setActivePage', { value: 'stores' });
        },
    }
</script>

<style scoped>

</style>
