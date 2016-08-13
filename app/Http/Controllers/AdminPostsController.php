<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use App\Tag;
use App\Photo;
use App\Http\Requests\PostsCreateRequest;
use Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNotIn('id', [5])->orderBy('id', 'desc')->get();
        $tags = Tag::orderBy('id', 'desc')->get();
        $photos = Photo::orderBy('id', 'desc')->get();
//        $next_tag_record_id = Tag::lastInsertId(null);
        return view('admin.posts.create', compact('categories', 'tags', 'photos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $input = $request->all();
        $user = Auth::user();
        $post = new Post();

        $input['user_id'] = $user->id;

        if (isset($input['publish'])) {
            $input['status'] = 'publish';

            $post->title = $input['title'];
            $post->user_id = $input['user_id'];
            $post->photo_id = $input['photo_id'];
            $post->body = $input['body'];
            $post->status = $input['status'];

            $post->save();

            // add to pivot table
            if (isset($input['categories'])) {
                $post->categories()->attach($input['categories']);
            } else {
                $post->categories()->attach(5);
            }

            if (isset($input['tags'])) {
                $post->tags()->attach($input['tags']);
            }

            return redirect('/admin/posts/create')->with('status', 'Post published!');
        } else {
            $input['status'] = 'draft';

            $post->title = $input['title'];
            $post->user_id = $input['user_id'];
            $post->photo_id = $input['photo_id'];
            $post->body = $input['body'];
            $post->status = $input['status'];

            $post->save();

            // add to pivot table
            if (isset($input['categories'])) {
                $post->categories()->attach(5);
            } else {
                $post->categories()->attach(5);
            }

            if (isset($input['tags'])) {
                $post->tags()->attach($input['tags']);
            }


            return redirect('/admin/posts/create')->with('status', 'Post saved!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $categories = Category::whereNotIn('id', [5])->orderBy('id', 'desc')->get();
        $tags = Tag::orderBy('id', 'desc')->get();
        $photos = Photo::orderBy('id', 'desc')->get();
        return view('admin.posts.edit', compact('categories', 'tags', 'photos', 'post', 'categoriesid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsCreateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $input = $request->all();
        $post->update($input);

        $post->categories()->sync($input['categories']);
        $post->tags()->sync($input['tags'], true);

        if ($input['status'] == 'publish') {
            return redirect('/admin/posts/' . $id. '/edit')->with('status', 'Post updated!');
        } else {
            return redirect('/admin/posts/' . $id. '/edit')->with('status', 'Post saved!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($id != 1) {
//            We don't it, because we used softDelete, so we still have related categories and tags if we restore post
//            $post->categories()->detach();
//            $post->tags()->detach();

            $post->delete();

            return redirect('/admin/posts')->with('status', 'Post deleted!');
        } else {
            return redirect('/admin/users')->with('status', 'This post cannot be deleted!');
        }
    }


    public function upload(Request $request)
    {

    }
}
