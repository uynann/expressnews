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
    public function index(Request $request)
    {
        $tag_all = Tag::all();

        $search = $request->input('search');

        if ($search != null)
        {
            $tags = Tag::SearchByKeyword($search)->orderBy('id', 'desc')->paginate(10);
            $param = 'search';
            $param_val = $search;
        } else
        {
            $tags = Tag::orderBy('id', 'desc')->paginate(10);
            $param = null;
            $param_val = null;
        }

        return view('admin.tags.index', compact('tags', 'tag_all' ,'param', 'param_val'));
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
        if (trim($input['slug']) == '') {
            $input['slug'] = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $input['name'])));
        }

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
        $tag->slug = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $tag->name)));
        $tag->save();
        $response = array(
            'status' => 'success',
            'msg'    => 'Comment submitted',
            'name'   => $tag->name,
            'id'     => $tag->id,
        );

        return \Response::json($response);
    }


    public function bulkActions(Request $request)
    {
        $input = $request->all();

        if(isset($input['checkboxTagsArray']))
        {
            $tag_count = count($input['checkboxTagsArray']);

            // Detach tag from posts, that are related to this deleted tag
            foreach($input['checkboxTagsArray'] as $id) {
                foreach(Tag::findOrFail($id)->posts as $post) {
                    $post->tags()->detach($id);
                }
            }


            Tag::whereIn('id', $input['checkboxTagsArray'])->delete();

            if ($tag_count == 1) {
                $status = $tag_count . ' tag deleted!';
            } else {
                $status = $tag_count . ' tags deleted!';
            }

            return redirect('/admin/tags')->with('status', $status);
        }
        else
        {
            return redirect('/admin/tags');
        }
    }

}
