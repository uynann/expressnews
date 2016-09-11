<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;
use Auth;

class AdminMediasController extends Controller
{
    public function index(Request $request) {

        $photos_all = Photo::orderBy('id', 'desc')->get();

        $view = $request->input('view');

        if ($view == 'list') {
            $photos = Photo::orderBy('id', 'desc')->paginate(15);
            $param = 'view';
            $param_val = $view;
            return view('admin.medias.index-list', compact('photos', 'photos_all', 'param', 'param_val'));
        } else {
            $photos = Photo::orderBy('id', 'desc')->paginate(50);
            return view('admin.medias.index', compact('photos', 'photos_all'));
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
}
