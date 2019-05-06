@extends('layouts.app')

@section('title', 'News')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="text-center">
                    DELETE NEWS
                </h1>
                <h2>
                    {{ $news->title }}
                </h2>
                <form action="{{ route('news.destroy', $news) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')
                    @include('news.delete-form-fields')
                    @include('partials.validation-errors')

                    <div class="row justify-content-center mt-4">
                        <div class="col-md-8  border border-danger">
                            <p class="text-uppercase font-weight-bolder m-4 text-danger">
                                Are you really want to delete this news?
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('news.edit', $news) }}">
                        <button type="button"
                                class="btn btn-light font-weight-bolder mt-4">
                            Cancel
                        </button>
                    </a>
                    <button type="submit"
                            class="btn btn-danger font-weight-bolder mt-4">
                        DELETE NEWS
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

