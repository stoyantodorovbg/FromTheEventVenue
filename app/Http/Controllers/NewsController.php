<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Models\Archivednews;
use App\Http\Requests\NewsRequest;
use App\Traits\ControllerUtilities;
use App\Http\Requests\DestroyNewsRequest;
use Illuminate\Database\Eloquent\Builder;

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
        $news = News::all();

        return view('news.index', compact('news'));
    }

    public function search()
    {
        $news = $this->createSearchQuery(request()->all())->get();

        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('news.create', compact('categories'));
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

        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(News $news)
    {
        $news->load('category');

        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $categories = Category::all();

        return view('news.edit', compact('news', 'categories'));
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

        return redirect()->route('news.show', $news);
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

    /**
     * Filter data by status
     *
     * @param array $params
     * @return Builder
     */
    protected function createSearchQuery(array $params): Builder
    {
        if(!isset($params['archived'])) {
            return News::addQueries($params);
        }

        unset($params['archived']);

        return Archivednews::addQueries($params);
    }
}
