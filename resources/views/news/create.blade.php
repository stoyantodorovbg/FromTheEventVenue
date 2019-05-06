@extends('layouts.app')

@section('title', 'News')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="text-center">
                    CREATE NEWS
                </h1>
                <form action="{{ route('news.store') }}"
                    method="POST">
                    @csrf
                    <add-news
                        :categories="{{ $categories }}"
                        :old_inputs_forms="{{ json_encode(session()->getOldInput()) }}"
                        :news_forms_count="{{ isset(session()->getOldInput()['news']) ? count(session()->getOldInput()['news']) : 1}}"
                    ></add-news>

                    @include('partials.validation-errors')

                    <a href="{{ route('news.index') }}">
                        <button type="button"
                                class="btn btn-light font-weight-bolder mt-4">
                            Cancel
                        </button>
                    </a>
                    <button type="submit"
                            class="btn btn-primary font-weight-bolder mt-4">
                        SUBMIT NEWS
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

