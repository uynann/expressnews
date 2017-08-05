<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Comment;
use Session;

class PostsController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category, $id_title)
    {
        $id = current(explode("-", $id_title));

        $postKey = 'post_' . $id;

        $post = Post::findOrFail($id);

        // Check if blog session key exists
        // If not, update view_count and create session key
        if (!Session::has($postKey))
        {
            $post->increment('view_count');
            Session::put($postKey, 1);
        }
        
        $similar_posts = Post::where('status', '=', 'publish')->where('category_id', $post->category_id)
            ->where('id', '<>', $post->id)
            ->orderBy('created_at', 'desc')
            ->take(4)->get();


        if ($post->category->slug == $category) {
            return view('show', compact('post', 'similar_posts'));
        } else {
            return view('errors.404');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
