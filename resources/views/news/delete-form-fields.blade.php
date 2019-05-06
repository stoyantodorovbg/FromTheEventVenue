<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <div class="input-group mb-3">
                        <select class="custom-select"
                                name="deletecriteria_id">
                            <option value="">Select Delete Criteria*</option>
                            @foreach($delete_criterias as $criteria)
                                <option value="{{ $criteria->id }}">
                                    {{ $criteria->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
