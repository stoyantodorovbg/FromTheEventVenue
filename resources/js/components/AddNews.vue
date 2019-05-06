<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="container-news-fields col-md-12">
                <news-fields
                    v-for="item in newsFields"
                    :key="item.id"
                    :form_id="item.id"></news-fields>
            </div>
            <button type="button"
                    @click="addNewsFields"
                    class="btn btn-success mt-3 mb-4">
                Add Another News
            </button>
        </div>
    </div>
</template>

<script>
    import NewsFields from './NewsFields';

    export default {
        components: {NewsFields},

        props: [
            'categories'
        ],

        data() {
            return {
                newsFields: [{ id: 1}],
            }
        },

        methods: {
            addNewsFields() {
                this.newsFields.push({ id: this.newsFields.length + 1 });
            }

        }
    }
</script>
