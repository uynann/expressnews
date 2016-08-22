<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Role;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use App\Photo;
use App\Post;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::whereNotIn('id', [14])->orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::lists('name', 'id')->all();
        $photos = Photo::orderBy('id', 'desc')->get();
        return view('admin.users.create', compact('roles', 'photos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //
        $input = $request->all();

        if ($input['role_id'] == '') {
            $input['role_id'] = 2;
        }

        $input['password'] = bcrypt($request->password);
        User::create($input);
        return redirect('/admin/users/create')->with('status', 'User created!');
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
        $user = User::findOrFail($id);
        $roles = Role::lists('name', 'id')->all();
        $photos = Photo::orderBy('id', 'desc')->get();
        return view('admin.users.edit', compact('user', 'roles', 'photos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        $user->update($input);
        return redirect('/admin/users/' . $id. '/edit')->with('status', 'User updated!');
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
        if ($id != 1 || $id !=14) {
            $user = User::findOrFail($id);

            // Asign Unknown user to posts, that are related to this deleted user
            Post::where('user_id', '=', $id)->update(['user_id' => 14]);

            $user->delete();
            return redirect('/admin/users')->with('status', 'User deleted!');
        } else {
            return redirect('/admin/users')->with('status', 'This user cannot be deleted!');
        }

    }

}
