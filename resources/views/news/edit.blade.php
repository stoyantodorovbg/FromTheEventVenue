@extends('layouts.app')

@section('title', 'News')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="text-center">
                    EDIT NEWS
                </h1>
                <form action="{{ route('news.update', $news) }}"
                      method="POST">

                    @csrf
                    @method('PATCH')
                    @include('news._edit-form-fields')
                    @include('partials.validation-errors')

                    <a href="{{ route('news.show', $news) }}">
                        <button type="button"
                                class="btn btn-light font-weight-bolder mt-4">
                            Cancel
                        </button>
                    </a>
                    <button type="submit"
                            class="btn btn-primary font-weight-bolder mt-4">
                        EDIT NEWS
                    </button>
                    <a href="{{ route('news.delete', $news) }}">
                        <button type="button"
                                class="btn btn-danger font-weight-bolder mt-4">
                            Delete news
                        </button>
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
