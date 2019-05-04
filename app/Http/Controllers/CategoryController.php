<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\ControllerUtilities;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    use ControllerUtilities;

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $this->generateSlug($request->validated(), 'title');

        $category = Category::create($data);

        return response(['category' => $category], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $this->generateSlug($request->validated(), 'title');

        $category->update($data);

        return response(['category' => $category], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response('Category deleted', 200);
    }
}
