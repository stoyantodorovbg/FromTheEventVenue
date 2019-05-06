<template>
    <div>
        <div class="row">
            <div class="col-md-6 input-group mb-3">
                <select class="custom-select"
                        name="category_id">
                    <option value="">Select Category</option>
                    <option v-for="category in categories"
                            :key="category.id"
                            :value="category.id">
                        {{ category.title}}
                    </option>
                </select>
            </div>
            <div class="col-md-6 input-group mb-3">
                <select class="custom-select"
                        id="archived-display"
                        @change="archivedChanged"
                        name="archived">
                    <option value="">Active News</option>
                    <option value="1">Deleted News</option>
                </select>
            </div>
        </div>
        <div v-if="delete_criteria_display" class="row">
            <div class="col-md-6 input-group mb-3">
                <select class="custom-select"
                        name="deletecriteria_id">
                    <option value="">Select Delete Criteria</option>
                    <option v-for="criteria in delete_criterias"
                            :key="criteria.id"
                            :value="criteria.id">
                        {{ criteria.title}}
                    </option>
                </select>
            </div>
            <div class="col-md-6 input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text text-uppercase">
                        Searching only for deleted news
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">News Created After</span>
                </div>
                <input name="created_at_after"
                       type="date"
                       class="form-control">
            </div>
            <div class="col-md-6 input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Only News Before</span>
                </div>
                <input name="created_at_before"
                       type="date"
                       class="form-control">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'categories',
            'delete_criterias',
        ],

        data() {
            return {
                delete_criteria_display: false,
            };
        },

        methods: {
            archivedChanged() {
                if($('#archived-display').val()) {
                    this.delete_criteria_display = true;
                } else {
                    this.delete_criteria_display = false;
                }
            },
        },
    }
</script>
