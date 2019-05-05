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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Category
                                </h4>
                                <h3 class="card-text font-weight-bolder text-uppercase">
                                    {{ $news->category->title }}
                                </h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Content
                                </h4>
                                <p class="card-text">
                                    {{ $news->body }}
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Event
                                </h4>
                                <h3 class="card-text">
                                    {{ $news->event }}
                                </h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Location
                                </h4>
                                <p class="card-text">
                                    {{ $news->location }}
                                </p>
                            </div>
                        </div>
                        <p class="text-right mt-3 mr-3 font-italic" >
                            {{ $news->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
