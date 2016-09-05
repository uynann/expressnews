<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CommentReply;
use App\Comment;
use App\Http\Requests\EditRepliesRequest;

class AdminCommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reply_all = CommentReply::all();
        $reply_unapproved = CommentReply::where('is_active', '=', 0)->get();
        $reply_approved = CommentReply::where('is_active', '=', 1)->get();

        $comment = $request->input('comment');
        $search = $request->input('search');
        $status = $request->input('status');

        if ($comment != null)
        {
            $comment_single = Comment::findOrFail($comment);
            $replies = $comment_single->replies()->orderBy('id', 'desc')->paginate(10);
            $param = 'comment';
            $param_val = $comment;
        }
        elseif ($search != null)
        {
            $replies = CommentReply::SearchByKeyword($search)->orderBy('id', 'desc')->paginate(10);
            $param = 'search';
            $param_val = $search;
        }
        elseif ($status != null)
        {

            if($status == 'approved') {
                $replies = CommentReply::where('is_active', '=', 1)->paginate(10);
            }
            elseif($status == 'unapproved') {
                $replies = CommentReply::where('is_active', '=', 0)->paginate(10);
            }
            $param = 'status';
            $param_val = $status;

        }
        else
        {
            $replies = CommentReply::orderBy('id', 'desc')->paginate(10);
            $param = null;
            $param_val = null;
        }

        return view('admin.comments.replies.index', compact('replies', 'reply_all', 'reply_unapproved', 'reply_approved', 'param', 'param_val', 'comment_single'));
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
    public function store(EditRepliesRequest $request)
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
    public function update(EditRepliesRequest $request, $id)
    {
        $input = $request->all();
        $input['reply'] = $input['comment'];
        $reply = CommentReply::findOrFail($id);
        $reply->update($input);

        $response = array(
            'status' => 'success',
            'msg'    => 'Reply updated!',
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
        CommentReply::findOrFail($id)->delete();

        $response = array(
            'status' => 'success',
            'msg'    => 'Reply deleted!',
        );

        return \Response::json($response);
    }


    public function approve(Request $request, $id)
    {

        CommentReply::findOrFail($id)->update(['is_active' => 1]);

        $response = array(
            'status' => 'success',
            'msg'    => 'Reply approved!',
            'reply_id' => $id,
        );

        return \Response::json($response);
    }


    public function unapprove(Request $request, $id)
    {

        CommentReply::findOrFail($id)->update(['is_active' => 0]);

        $response = array(
            'status' => 'success',
            'msg'    => 'Reply unapproved!',
            'reply_id' => $id,
        );

        return \Response::json($response);
    }


    public function bulkActions(Request $request)
    {
        $input = $request->all();

        if(isset($input['checkboxCommentRepliesArray'])) {

            $reply_count = count($input['checkboxCommentRepliesArray']);

            if (isset($input['approve'])) {
                CommentReply::whereIn('id', $input['checkboxCommentRepliesArray'])->update(['is_active' => 1]);

                if ($reply_count == 1) {
                    $status = $reply_count . ' reply approved!';
                } else {
                    $status = $reply_count . ' replies approved!';
                }

            } elseif (isset($input['unapprove'])) {
                CommentReply::whereIn('id', $input['checkboxCommentRepliesArray'])->update(['is_active' => 0]);

                if ($reply_count == 1) {
                    $status = $reply_count . ' reply unapproved!';
                } else {
                    $status = $reply_count . ' replies unapproved!';
                }

            } elseif (isset($input['delete'])) {

                CommentReply::whereIn('id', $input['checkboxCommentRepliesArray'])->delete();

                if ($reply_count == 1) {
                    $status = $reply_count . ' comment deleted!';
                } else {
                    $status = $reply_count . ' comments deleted!';
                }
            } else {
                return redirect('/admin/comment/replies');
            }

            return redirect('/admin/comment/replies')->with('status', $status);

        } else {
            return redirect('/admin/comment/replies');
        }
    }

}
