<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::whereNotIn('id', [5])->get();
        return view('home', compact('categories'));
    }

    public function category($category_name) {
        $categories = Category::all();
        foreach ($categories as $category_obj) {
            if (preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $category_obj->name))) == $category_name) {
                $category = $category_obj;
            }
        }

        $posts = $category->posts()->orderBy('id', 'desc')->paginate(5);

        return view('category', compact('category', 'posts'));
    }
}
