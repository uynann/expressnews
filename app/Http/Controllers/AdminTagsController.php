<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use App\Http\Requests\TagsRequest;
use App\Http\Requests\TagsEditRequest;

class AdminTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('id', 'desc')->get();
        return view('admin.tags.index', compact('tags'));
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
    public function store(TagsRequest $request)
    {
        $input = $request->all();
        Tag::create($input);
        return redirect('/admin/tags')->with('status', 'Tag created!');
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
        $tag = Tag::findOrFail($id);
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagsEditRequest $request, $id)
    {
        $input = $request->all();
        Tag::findOrFail($id)->update($input);
        return redirect('/admin/tags/' . $id. '/edit')->with('status', 'Tag updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Detach tag from posts, that are related to this deleted tag
        foreach(Tag::findOrFail($id)->posts as $post) {
            $post->tags()->detach($id);
        }

        Tag::findOrFail($id)->delete();
        return redirect('/admin/tags')->with('status', 'Tag deleted!');
    }

    public function storeFromAjax(TagsRequest $request)
    {
        $input = $request->all();
        $tag = new Tag();
        $tag->name = $input['name'];
        $tag->save();
        $response = array(
            'status' => 'success',
            'msg'    => 'Comment submitted',
            'name'   => $tag->name,
            'id'     => $tag->id,
        );

        return \Response::json($response);
    }

}
