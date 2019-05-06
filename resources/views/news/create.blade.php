@extends('layouts.app')

@section('title', 'News')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="text-center">
                    CREATE NEWS
                </h1>
                <form action="{{ route('news.store') }}">
                    <add-news
                        :categories="{{ $categories }}"></add-news>

                    <button type="submit"
                            class="btn btn-primary font-weight-bolder mt-4">
                        SUBMIT NEWS
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

