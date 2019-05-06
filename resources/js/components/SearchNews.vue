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
                <input type="hidden"
                       name="created_at_after"
                       class="created_at_after_hidden">
                <input type="date"
                       class="form-control created_at_after"
                       @change="addTimeToDate('after')">
                <input name="created_at_after_time"
                       type="time"
                       class="form-control created_at_after_time"
                       @change="addTimeToDate('after')">
            </div>
            <div class="col-md-6 input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Only News Before</span>
                </div>
                <input type="hidden"
                       name="created_at_before"
                       class="created_at_before_hidden">
                <input type="date"
                       class="form-control created_at_before"
                       @change="addTimeToDate('before')">
                <input name="created_at_before_time"
                       type="time"
                       class="form-control created_at_before_time"
                       @change="addTimeToDate('before')">
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

            addTimeToDate(key) {
                $('.created_at_' + key + '_hidden').val($('.created_at_' + key).val() + ' ' + $('.created_at_' + key + '_time').val());
            }
        },
    }
</script>
