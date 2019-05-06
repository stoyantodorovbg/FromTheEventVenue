@extends('layouts.app')

@section('title', 'News')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">
                            {{ $news->title }}
                        </h1>
                    </div>
                    <div class="card-body p-0">
                        <div class="card m-1">
                            <div class="card-body">
                                <h3 class="card-text font-weight-bolder text-uppercase">
                                    <span class="font-italic">Category:</span> {{ $news->category->title }}
                                </h3>
                            </div>
                        </div>
                        <div class="card m-1">
                            <div class="card-body">
                                <p class="card-text">
                                    {{ $news->body }}
                                </p>
                            </div>
                        </div>
                        <div class="card m-1">
                            <div class="card-body">
                                <h3 class="card-text">
                                    <span class="font-italic">Event:</span> {{ $news->event }}
                                </h3>
                            </div>
                        </div>
                        <div class="card m-1">
                            <div class="card-body">
                                <p class="card-text">
                                    <span class="font-italic">Location:</span> {{ $news->location }}
                                </p>
                            </div>
                        </div>
                        <a class="float-left m-3"
                            href="{{ route('news.edit', $news) }}">
                            <button type="button"
                                    class="btn btn-success font-weight-bolder">
                                Edit News
                            </button>
                        </a>
                        <p class="float-right mt-3 mr-3 font-italic" >
                            {{ $news->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
