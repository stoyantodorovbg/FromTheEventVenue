@extends('layouts.app')

@section('title', 'News')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-12">
                @include('news._search-form')
                @if(!session()->pull('archived-news'))
                    <h1 class="text-center">
                        {{ $news->count() }} NEWS
                    </h1>
                @else
                    <h1 class="text-center text-danger">
                        {{ $news->count() }} ARCHIVED NEWS
                    </h1>
                @endif
                @include('news._list')
            </div>
        </div>
    </div>
@endsection
