@extends('layouts.app')

@section('title', 'News')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-12">
                @include('news._search-form')
                <h1 class="text-center">
                    {{ $news->count() }} NEWS
                </h1>
                @include('news._list')
            </div>
        </div>
    </div>
@endsection
