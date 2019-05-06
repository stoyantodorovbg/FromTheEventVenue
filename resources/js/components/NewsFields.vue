<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">NEWS</div>

                    <div class="card-body text-center">

                        <div class="input-group mb-3">
                            <select class="custom-select"
                                    name="category_id">
                                <option>Select Category*</option>
                                <option v-for="category in $parent.categories"
                                        :key="category.id"
                                        :value="category.id">
                                    {{ category.title}}
                                </option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input name="title"
                                   type="text"
                                   placeholder="News Title*"
                                   class="form-control"
                                   aria-label="title"
                                   aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <textarea name="body"
                                      placeholder="News Content*"
                                      class="form-control"
                                      rows="4"
                                      aria-label="With textarea"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <textarea name="event"
                                      placeholder="News Event"
                                      class="form-control"
                                      rows="2"
                                      aria-label="With textarea"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <textarea name="location"
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

    }
</script>
