<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use App\CommentReply;
use App\Post;
use App\Http\Requests\CommentsRequest;

class AdminCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comment_all = Comment::all();
        $comment_unapproved = Comment::where('is_active', '=', 0)->get();
        $comment_approved = Comment::where('is_active', '=', 1)->get();

        $post = $request->input('post');
        $search = $request->input('search');
        $status = $request->input('status');

        if ($post != null)
        {
            $post_single = Post::findOrFail($post);
            $comments = $post_single->comments()->orderBy('id', 'desc')->paginate(10);
            $param = 'post';
            $param_val = $post;

        }
        elseif ($search != null)
        {
            $comments = Comment::SearchByKeyword($search)->orderBy('id', 'desc')->paginate(10);
            $param = 'search';
            $param_val = $search;
        }
        elseif ($status != null)
        {

            if($status == 'approved') {
                $comments = Comment::where('is_active', '=', 1)->paginate(10);
            }
            elseif($status == 'unapproved') {
                $comments = Comment::where('is_active', '=', 0)->paginate(10);
            }
            $param = 'status';
            $param_val = $status;

        }
        else
        {
            $comments = Comment::orderBy('id', 'desc')->paginate(10);
            $param = null;
            $param_val = null;
        }


        return view('admin.comments.index', compact('comments', 'param', 'param_val', 'comment_all', 'comment_unapproved', 'comment_approved', 'post_single'));
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
    public function store(CommentsRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentsRequest $request, $id)
    {

        $input = $request->all();
        $comment = Comment::findOrFail($id);
        $comment->update($input);

        $response = array(
            'status' => 'success',
            'msg'    => 'Comment edited!',
        );

        return \Response::json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        CommentReply::where('comment_id', '=', $id)->delete();
        Comment::findOrFail($id)->delete();

        $response = array(
            'status' => 'success',
            'msg'    => 'Comment deleted!',
        );

        return \Response::json($response);
    }


    public function approve(Request $request, $id)
    {

        Comment::findOrFail($id)->update(['is_active' => 1]);

        $response = array(
            'status' => 'success',
            'msg'    => 'Comment approved!',
            'comment_id' => $id,
        );

        return \Response::json($response);
    }


    public function unapprove(Request $request, $id)
    {

        Comment::findOrFail($id)->update(['is_active' => 0]);

        $response = array(
            'status' => 'success',
            'msg'    => 'Comment unapproved!',
            'comment_id' => $id,
        );

        return \Response::json($response);
    }


    public function bulkActions(Request $request)
    {
        $input = $request->all();

        if(isset($input['checkboxCommentsArray'])) {

            $comment_count = count($input['checkboxCommentsArray']);

            if (isset($input['approve'])) {
                Comment::whereIn('id', $input['checkboxCommentsArray'])->update(['is_active' => 1]);

                if ($comment_count == 1) {
                    $status = $comment_count . ' comment approved!';
                } else {
                    $status = $comment_count . ' comments approved!';
                }

            } elseif (isset($input['unapprove'])) {
                Comment::whereIn('id', $input['checkboxCommentsArray'])->update(['is_active' => 0]);

                if ($comment_count == 1) {
                    $status = $comment_count . ' comment unapproved!';
                } else {
                    $status = $comment_count . ' comments unapproved!';
                }

            } elseif (isset($input['delete'])) {
                foreach($input['checkboxCommentsArray'] as $id) {
                    CommentReply::where('comment_id', '=', $id)->delete();
                }

                Comment::whereIn('id', $input['checkboxCommentsArray'])->delete();

                if ($comment_count == 1) {
                    $status = $comment_count . ' comment deleted!';
                } else {
                    $status = $comment_count . ' comments deleted!';
                }
            } else {
                return redirect('/admin/comments');
            }

            return redirect('/admin/comments')->with('status', $status);

        } else {
            return redirect('/admin/comments');
        }
    }


}
