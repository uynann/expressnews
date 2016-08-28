<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CommentReply;
use App\Http\Requests\EditRepliesRequest;

class AdminCommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $replies = CommentReply::orderBy('id', 'desc')->paginate(10);
        return view('admin.comments.replies.index', compact('replies'));
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
            'msg'    => 'Reply updated',
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
            'msg'    => 'Reply deleted',
        );

        return \Response::json($response);
    }
}
