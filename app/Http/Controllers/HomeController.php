<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\Post;

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
            if ($category_obj->slug == $category_name) {
                $category = $category_obj;
            }
        }


        $posts = $category->postsPublished()->orderBy('id', 'desc')->simplePaginate(8);

        return view('category', compact('category', 'posts'));
    }

    public function about() {
        return view('about');
    }

    public function contact() {
        return view('contact');
    }

    public function privacyPolicy() {
        return view('privacy-policy');
    }


    public function search(Request $request) {
        $search = $request->input('search');

        if ($search != null) {
            $posts = Post::SearchByKeyword($search)->orderBy('id', 'desc')->simplePaginate(10);
            $posts_all = Post::SearchByKeyword($search)->get();

        }
        $param = 'search';
        $param_val = $search;

        return view('search', compact('posts', 'search', 'param', 'param_val', 'posts_all'));



    }

}
