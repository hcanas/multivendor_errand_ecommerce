<template>
    <div class="flex flex-col">
        <div class="flex items-center justify-between items-center pb-1 mb-1 border-b">
            <p class="text-xl lg:text-lg font-medium">Activity Log</p>
            <div class="relative">
                <button-primary @click="show_filter = !show_filter">
                    <div class="flex items-center space-x-0.5 lg:text-sm">
                        <i class="fas fa-search"></i>
                        <span>Search</span>
                    </div>
                </button-primary>
                <div id="filter" :class="`${showFilter} absolute top-10 lg:top-8 right-0 w-80 overflow-hidden rounded-b`">
                    <form>
                        <div class="flex flex-col my-2">
                            <form-label>Keyword</form-label>
                            <form-input type="text" :value="filter.keyword" @input="filter.keyword = $event.target.value"></form-input>
                        </div>

                        <div class="flex flex-col my-2">
                            <form-label>Date From</form-label>
                            <form-input type="datetime-local" :value="filter.date_from" @input="filter.date_from = $event.target.value"></form-input>
                        </div>

                        <div class="flex flex-col my-2">
                            <form-label>Date To</form-label>
                            <form-input type="datetime-local" :value="filter.date_to" @input="filter.date_to = $event.target.value"></form-input>
                        </div>

                        <div class="flex flex-col my-2">
                            <button-primary type="submit" @click.prevent="updateFilter()">Apply</button-primary>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <p v-if="activities" v-for="activity in activities" :key="activity.id" class="flex items-center space-x-2 my-1">
            <span>{{ activity.overview }}</span>
            <span class="text-gray-500 text-xs">{{ activity.created_at }}</span>
        </p>

        <records-not-found v-if="show_404"></records-not-found>

        <pagination v-if="pagination" :data="pagination"></pagination>
    </div>
</template>

<script>
    import LinkPrimary from "../../components/links/Primary";
    import FormLabel from "../../components/form/Label";
    import FormInput from "../../components/form/Input";
    import ButtonPrimary from "../../components/buttons/Primary";
    import RecordsNotFound from "../../components/errors/RecordsNotFound";
    import Pagination from "../../components/nav/Pagination";

    export default {
        name: "ActivityLog",
        components: {
            Pagination,
            LinkPrimary,
            FormLabel,
            FormInput,
            ButtonPrimary,
            RecordsNotFound,
        },
        created() {
            this.$store.dispatch('navigation/setActiveProfilePage', 'activity_log');

            if (Object.keys(this.$route.query).length > 0) {
                const query = this.$route.query;

                this.filter = {
                    keyword: query.keyword ?? '',
                    date_from: query.date_from ?? '',
                    date_to: query.date_to ?? '',
                    page: query.page ?? 1,
                    per_page: query.per_page ?? 15,
                };
            }

            this.loadActivities();
        },
        data() {
            return {
                activities: null,
                pagination: null,
                show_filter: false,
                show_404: false,
                filter: {
                    keyword: '',
                    date_from: '',
                    date_to: '',
                    page: 1,
                    per_page: 15,
                },
            }
        },
        methods: {
            createFilter() {
                const filter = [];

                Object.keys(this.filter).forEach(key => {
                    if (this.filter[key] !== '') {
                        filter.push(key + '=' + this.filter[key]);
                    }
                });

                return filter.join('&');
            },
            updateFilter() {
                this.$router.push(this.$route.path + '?' + this.createFilter());
                this.show_filter = false;
            },
            loadActivities(filter) {
                axios.get(`/api/users/${this.$route.params.id}/activities?${filter ?? this.createFilter()}`, {
                        headers: {
                            Authorization: `Bearer ${this.$store.getters['auth/getToken']}`,
                        },
                    })
                    .then(response => {
                        console.log(response.data);
                        this.activities = response.data.data;
                        this.show_404 = false;

                        if (response.data.meta.last_page > 1) {
                            this.pagination = response.data.meta;

                            Object.keys(this.pagination.links).forEach(key => {
                                this.pagination.links[key].url = this.pagination.links[key].url?.replace(
                                    this.pagination.path,
                                    this.$route.path
                                );
                            });

                            this.pagination.links[0].label = '&lt;';
                            this.pagination.links[this.pagination.links.length - 1].label = '&gt;';
                        } else {
                            this.pagination = null;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        this.activities = null;
                        this.pagination = null;
                        this.show_404 = true;
                    });
            },
        },
        computed: {
            showFilter() {
                return this.show_filter ? 'show' : 'hide';
            },
        },
    }
</script>

<style scoped>
    #filter.show {
        @apply p-4 bg-gray-50 border
    }

    #filter.hide {
        @apply h-0
    }
</style>
