<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\CategoriesEditRequest;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::whereNotIn('id', [5])->orderBy('id', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        $input = $request->all();
        Category::create($input);
        return redirect('/admin/categories')->with('status', 'Category created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesEditRequest $request, $id)
    {
        $input = $request->all();
        $category = Category::findOrFail($id);
        $category->update($input);
        return redirect('/admin/categories/' . $id. '/edit')->with('status', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Detach category from posts, that are related to this deleted category
        foreach(Category::findOrFail($id)->posts as $post) {
            if ($post->categories->count() > 1) {
                $post->categories()->detach($id);
            } else {
                $post->categories()->sync([5], true);
            }
        }

        Category::findOrFail($id)->delete();
        return redirect('/admin/categories')->with('status', 'Category deleted!');
    }
}
