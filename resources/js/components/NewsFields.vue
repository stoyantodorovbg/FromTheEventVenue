<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">NEWS FORM {{ form_id + 1}}</div>

                    <div class="card-body text-center">

                        <div class="input-group mb-3">
                            <select class="custom-select"
                                    :name="'news[' + form_id + '][category_id]'">
                                <option value="">Select Category*</option>
                                <option v-for="category in $parent.categories"
                                        :selected="isOptionSelected(category.id)"
                                        :key="category.id"
                                        :value="category.id">
                                    {{ category.title}}
                                </option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input :name="'news[' + form_id + '][title]'"
                                   :value="getOldInputValue('title')"
                                   type="text"
                                   placeholder="News Title*"
                                   class="form-control"
                                   aria-label="title"
                                   aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <textarea :name="'news[' + form_id + '][body]'"
                                      :value="getOldInputValue('body')"
                                      placeholder="News Content*"
                                      class="form-control"
                                      rows="4"
                                      aria-label="With textarea"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <textarea :name="'news[' + form_id + '][event]'"
                                      :value="getOldInputValue('event')"
                                      placeholder="News Event"
                                      class="form-control"
                                      rows="2"
                                      aria-label="With textarea"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <textarea :name="'news[' + form_id + '][location]'"
                                      :value="getOldInputValue('location')"
                                      placeholder="News Location"
                                      class="form-control"
                                      rows="2"
                                      aria-label="With textarea"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'form_id',
            'old_inputs_form',
        ],

        methods: {
            getOldInputValue(input_name) {
                return this.old_inputs_form ? this.old_inputs_form[input_name] : '';
            },

            isOptionSelected(option_id) {
                if(this.old_inputs_form) {
                    return this.old_inputs_form['category_id'] == option_id;
                }

                return false;
            }
        },
    }
</script>
