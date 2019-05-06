<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="container-news-fields col-md-12">
                <news-fields
                    v-for="item in newsForms"
                    :key="item.id"
                    :form_id="item.id"
                    :old_inputs_form="setOldInputForm(item.id)"></news-fields>
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
            'categories',
            'old_inputs_forms',
            'news_forms_count',
        ],

        data() {
            return {
                newsForms: this.setInitialNewsForms(),
            }
        },

        methods: {
            setInitialNewsForms() {
                let counter = 0;
                let newsForms = [];

                while(counter < this.news_forms_count) {
                    newsForms.push({ id: counter });
                    counter++;
                }

                return newsForms;
            },

            addNewsFields() {
                this.newsForms.push({ id: this.newsForms.length });
            },

            setOldInputForm(form_id) {
                return this.old_inputs_forms.news ?
                    this.old_inputs_forms.news[form_id] :
                    false;
            }
        }
    }
</script>
