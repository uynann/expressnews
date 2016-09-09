<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;
use Auth;

class AdminMediasController extends Controller
{
    public function index() {
        $photos = Photo::orderBy('id', 'desc')->paginate(28);;
        return view('admin.medias.index', compact('photos'));
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

        // move the file to correct location
        $file->move('images', $filename);

        // save the image details into the database
        $photo = Photo::create([
            'file_name' => $filename,
            'file_size' => $file->getClientSize(),
            'file_mime' => $file->getClientMimeType(),
            'file_path' => 'images/' . $filename,
            'user_id'   => Auth::user()->id,
        ]);

        return $photo;
    }
}
