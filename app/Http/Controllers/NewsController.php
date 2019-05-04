<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\NewsRequest;
use App\Traits\ControllerUtilities;
use App\Http\Requests\DestroyNewsRequest;

class NewsController extends Controller
{
    use ControllerUtilities;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  NewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $news = [];

        foreach ($request->validated()['news'] as $news_data) {
            $news_data = $this->generateSlug($news_data, 'title');
            $news[] = News::create($news_data);
        }

        return response($news, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  NewsRequest  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        $data = $this->generateSlug($request->validated()['news'][0], 'title');

        $news->update($data);

        return response($news, 200);
    }

    /**
     * Remove the specified resource from storage
     *
     * @param DestroyNewsRequest $requestNews
     * @param News $news
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DestroyNewsRequest $requestNews, News $news)
    {
        $news->archive($requestNews->validated());
        $news->delete();

        return response('News deleted', 200);
    }
}
