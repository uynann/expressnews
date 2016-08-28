<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CommentsRequest;
use Auth;
use App\Comment;
use App\Post;

class CommentsController extends Controller
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
    public function store(CommentsRequest $request)
    {
         $input = $request->all();

         $comment = new Comment();
         $comment->user_id = Auth::user()->id;
         $comment->post_id = $input['post_id'];
         $comment->comment = $input['comment'];

         $response = array(
          'status' => 'success',
          'msg'    => 'Comment submitted',
          'comment'=> $comment->comment,
          'user'   => Auth::user()->username,
          'user_img' => isset(Auth::user()->photo) ? asset(Auth::user()->photo->file_path) : 'https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg',
         );

         $comment->save();

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
