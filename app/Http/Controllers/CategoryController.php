<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return CategoryResource::collection(Category::latest()->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  SaveCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCategoryRequest $request)
    {
        $category = $request->createCategory();
        return response(new CategoryResource($category), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param SaveCategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(SaveCategoryRequest $request, Category $category)
    {
        $category =$request->updateCategory($category);
        return response(new CategoryResource($category), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
