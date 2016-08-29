<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Comment;
use App\Post;
use App\CommentReply;
use App\Http\Requests\CreateRepliesRequest;

class RepliesController extends Controller
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
    public function store(CreateRepliesRequest $request)
    {
        $input = $request->all();

        $reply = new CommentReply();
        $reply->user_id = Auth::user()->id;
        $reply->post_id = $input['post_id'];
        $reply->reply = $input['reply'];
        $reply->comment_id = $input['comment_id'];
        $reply->to_user = $input['to_user'];

        $response = array(
            'status' => 'success',
            'msg'    => 'Comment submitted',
            'reply'=> $reply->reply,
            'user'   => Auth::user()->username,
            'to_user' => $reply->userReply->username,
            'user_img' => isset(Auth::user()->photo) ? asset(Auth::user()->photo->file_path) : 'https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg',
            'post_id' => $reply->post_id,
            'comment_id' => $reply->comment_id,
        );

        $reply->save();

        return \Response::json($response);
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
