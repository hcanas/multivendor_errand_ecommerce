<template>
    <div class="flex flex-col lg:flex-row space-y-2 lg:space-y-0 justify-between items-center my-4">
        <div class="text-gray-500 text-xs uppercase">Displaying {{ data.from }} &ndash; {{ data.to }} of {{ data.total }} results.</div>
        <div class="flex space-x-2">
            <pagination-item
                v-for="link in data.links"
                :key="link.label"
                :to="link.url ?? ''"
                :is_static="typeof link.url === 'undefined'"
                :label="link.label"
                :is_active="link.active">
            </pagination-item>
        </div>
    </div>
</template>

<script>
    import PaginationItem from "./PaginationItem";

    export default {
        name: "Pagination",
        components: {
            PaginationItem,
        },
        props: {
            data: Object,
        },
    }
</script>

<style scoped>

</style>
