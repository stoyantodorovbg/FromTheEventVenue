<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <div class="input-group mb-3">
                        <select class="custom-select"
                                name="news[0][category_id]">
                            <option value="">Select Category*</option>
                            @foreach($categories as $category)
                                <option {{ $category->id === $news->category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input name="news[0][title]"
                               value="{{ $news->title }}"
                               type="text"
                               placeholder="News Title*"
                               class="form-control"
                               aria-label="title"
                               aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                            <textarea name="news[0][body]"
                                      placeholder="News Content*"
                                      rows="10"
                                      class="form-control"
                                      aria-label="With textarea"
                            >{{ $news->body }}
                            </textarea>
                    </div>
                    <div class="input-group mb-3">
                            <textarea name="news[0][event]"
                                      placeholder="News Event"
                                      rows="2"
                                      class="form-control"
                                      aria-label="With textarea"
                            >{{ $news->event }}
                            </textarea>
                    </div>
                    <div class="input-group mb-3">
                            <textarea name="news[0][location]"
                                      placeholder="News Location"
                                      rows="2"
                                      class="form-control"
                                      aria-label="With textarea"
                            >{{ $news->location }}
                            </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
