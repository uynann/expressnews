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
use App\Comment;
use App\CommentReply;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post_all = Post::all();
        $post_published = Post::where('status', '=', 'publish')->get();
        $post_draft = Post::where('status', '=', 'draft')->get();
        $post_trash = Post::onlyTrashed()->get();

        $category_name = $request->input('category'); // Get the get veriable category
        $tag_name = $request->input('tag'); // Get the get veriable tag
        $search = $request->input('search');
        $status = $request->input('status');

        if ($category_name != null) {
            foreach ($categories as $category_obj) {
                if (str_slug($category_obj->name) == $category_name) {
                    $category = $category_obj;
                }
            }

            $posts = Post::where('category_id', '=', $category->id)->orderBy('id', 'desc')->paginate(10);
        } elseif ($tag_name != null) {
            foreach ($tags as $tag_obj) {
                if (str_slug($tag_obj->name) == $tag_name) {
                    $tag = $tag_obj;
                }
            }

            $posts = Post::whereHas('tags', function ($query) use ($tag) {
                $query->where('name', '=', $tag->name);
            })->paginate(10);

        } elseif ($search != null) {
            $posts = Post::SearchByKeyword($search)->orderBy('id', 'desc')->paginate(10);
        } elseif ($status != null) {

            switch($status) {
                case 'published':
                    $posts = Post::where('status', '=', 'publish')->orderBy('id', 'desc')->paginate(10);
                    break;
                case 'draft':
                    $posts = Post::where('status', '=', 'draft')->orderBy('id', 'desc')->paginate(10);
                    break;
                case 'all':
                    $posts = Post::orderBy('id', 'desc')->paginate(10);
                    break;
                case 'trash':
                    $posts = Post::onlyTrashed()->orderBy('id', 'desc')->paginate(10);
                    break;
                default:
                    break;

            }

        }

        else {
            $posts = Post::orderBy('id', 'desc')->paginate(10);
        }

        return view('admin.posts.index', compact('posts', 'categories', 'post_all', 'post_published', 'post_draft', 'post_trash'));
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

            if (isset($input['category_id'])) {
                $post->category_id = $input['category_id'];
            } else {
                $post->category_id = 5;
            }


            $post->save();

            // add to pivot table
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

            if (isset($input['category_id'])) {
                $post->category_id = $input['category_id'];
            } else {
                $post->category_id = 5;
            }

            $post->save();

            // add to pivot table
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
        return view('admin.posts.edit', compact('categories', 'tags', 'photos', 'post'));
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

        if (isset($input['tags'])) {
            $post->tags()->sync($input['tags'], true);
        } else {
            $post->tags()->detach();
        }


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
//            We don't delete it, because we used softDelete, so we still have related categories and tags if we restore post
//            $post->tags()->detach();
            Comment::where('post_id', '=', $id)->delete();
            CommentReply::where('post_id', '=', $id)->delete();
            $post->delete();

            return redirect('/admin/posts')->with('status', 'Post deleted!');
        } else {
            return redirect('/admin/users')->with('status', 'This post cannot be deleted!');
        }
    }


    public function bulkActions(Request $request)
    {
        $input = $request->all();

        if(isset($input['checkboxPostsArray'])) {

            $post_count = count($input['checkboxPostsArray']);

            if (isset($input['markDraft'])) {
                Post::whereIn('id', $input['checkboxPostsArray'])->update(['status' => 'draft']);

                if ($post_count == 1) {
                    $status = $post_count . ' post saved!';
                } else {
                    $status = $post_count . ' posts saved!';
                }

            } elseif (isset($input['publish'])) {
                Post::whereIn('id', $input['checkboxPostsArray'])->update(['status' => 'publish']);

                if ($post_count == 1) {
                    $status = $post_count . ' post published!';
                } else {
                    $status = $post_count . ' posts published!';
                }

            } else {
                foreach($input['checkboxPostsArray'] as $id) {
                    Comment::where('post_id', '=', $id)->delete();
                    CommentReply::where('post_id', '=', $id)->delete();
                }

                Post::whereIn('id', $input['checkboxPostsArray'])->delete();

                if ($post_count == 1) {
                    $status = $post_count . ' post deleted!';
                } else {
                    $status = $post_count . ' posts deleted!';
                }
            }

            return redirect('/admin/posts')->with('status', $status);

        } else {
            return redirect('/admin/posts');
        }

    }

}
