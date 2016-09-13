<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Post;
use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\CategoriesEditRequest;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search != null)
        {
            $categories = Category::SearchByKeyword($search)->whereNotIn('id', [5])->orderBy('id', 'desc')->get();
        }
        else
        {
            $categories = Category::whereNotIn('id', [5])->orderBy('id', 'desc')->get();
        }

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

        if (trim($input['slug']) == '') {
            $input['slug'] = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $input['name'])));
        }

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

        Post::where('category_id', '=', $id)->update(['category_id' => 5]);

        Category::findOrFail($id)->delete();
        return redirect()->back()->with('status', 'Category deleted!');
    }


    public function bulkActions(Request $request)
    {
        $input = $request->all();

        if(isset($input['checkboxCategoriesArray']))
        {
            $category_count = count($input['checkboxCategoriesArray']);

            foreach($input['checkboxCategoriesArray'] as $id) {
                Post::where('category_id', '=', $id)->update(['category_id' => 5]);
            }

            Category::whereIn('id', $input['checkboxCategoriesArray'])->delete();

            if ($category_count == 1) {
                $status = $category_count . ' category deleted!';
            } else {
                $status = $category_count . ' categories deleted!';
            }

            return redirect()->back()->with('status', $status);
        }
        else
        {
            return redirect()->back();
        }

    }
}
