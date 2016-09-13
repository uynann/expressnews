<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;
use App\Post;
use App\User;
use Auth;

class AdminMediasController extends Controller
{
    public function index(Request $request) {

        $photos_all = Photo::orderBy('id', 'desc')->get();

        $view = $request->input('view');
        $search = $request->input('search');

        if ($view == 'list') {

            if ($search != null)
            {
                $photos = Photo::SearchByKeyword($search)->orderBy('id', 'desc')->paginate(15);
                $param1 = 'search';
                $param1_val = $search;
            } else {
                $photos = Photo::orderBy('id', 'desc')->paginate(15);
                $param1 = null;
                $param1_val = null;
            }

            $param = 'view';
            $param_val = $view;
            return view('admin.medias.index-list', compact('photos', 'photos_all', 'param', 'param_val', 'param1', 'param1_val'));
        } else {

            if ($search != null)
            {
                $photos = Photo::SearchByKeyword($search)->orderBy('id', 'desc')->paginate(50);
                $param1 = 'search';
                $param1_val = $search;
            } else {
                $photos = Photo::orderBy('id', 'desc')->paginate(50);
                $param1 = null;
                $param1_val = null;
            }

            return view('admin.medias.index', compact('photos', 'photos_all', 'param1', 'param1_val'));
        }

    }

    public function create() {
        return view('admin.medias.create');
    }

    public function store(Request $request)
    {
        // get the file from the post request
        $file = $request->file('file');

        // set my file name
        $filename = uniqid() . $file->getClientOriginalName();

        // Create a folder in public dir, if it doesn't exist
//        if (!file_exists('images')) {
//            mkdir('images', 0777, true);
//        }

        // move the file to correct location
        $file->move('images', $filename);

        // save the image details into the database
        $photo = Photo::create([
            'file_name' => $filename,
            'file_size' => $file->getClientSize(),
            'file_mime' => $file->getClientMimeType(),
            'file_path' => 'images/' . $filename,
            'user_id'   => Auth::user()->id,
//            file->get
        ]);

        return $photo;
    }


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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        if ($id != 1) {
            Post::where('photo_id', '=', $id)->update(['photo_id' => 0]);
            User::where('photo_id', '=', $id)->update(['photo_id' => 0]);
            unlink(public_path($photo->file_path));
            $photo->delete();

            return redirect()->back()->with('status', 'Photo deleted!');
        } else {
            return redirect()->back()->with('status', 'This photo cannot be deleted!');
        }
    }


    public function bulkActions(Request $request)
    {
        $input = $request->all();

        if(isset($input['checkboxMediasArray'])) {

            $photo_count = count($input['checkboxMediasArray']);

            if (isset($input['delete'])) {

                foreach($input['checkboxMediasArray'] as $id) {
                    Post::where('photo_id', '=', $id)->update(['photo_id' => 0]);
                    User::where('photo_id', '=', $id)->update(['photo_id' => 0]);
                    unlink(public_path(Photo::findOrFail($id)->file_path));
                }

                Photo::whereIn('id', $input['checkboxMediasArray'])->delete();

                if ($photo_count == 1) {
                    $status = $photo_count . ' photo deleted!';
                } else {
                    $status = $photo_count . ' photos deleted!';
                }
            }

            return redirect()->back()->with('status', $status);

        } else {
            return redirect()->back();
        }

        return $input;

    }

}
