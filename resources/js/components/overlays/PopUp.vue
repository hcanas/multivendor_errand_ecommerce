<template>
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gray-100 opacity-95"></div>
        <div class="absolute inset-0 flex flex-col justify-center items-center">
            <button-icon-dark :icon="`fas fa-times`" @click="$emit('close')"></button-icon-dark>
            <slot></slot>
        </div>
    </div>
</template>

<script>
    import ButtonIconDark from "../buttons/IconDark";

    export default {
        name: "PopUp",
        components: {
            ButtonIconDark,
        },
    }
</script>

<style scoped>

</style>
