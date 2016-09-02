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
use App\Comment;
use App\CommentReply;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::all();

        $user_all = User::whereNotIn('id', [14])->get();
        $user_admin = User::whereHas('role', function ($query) {
            $query->where('name', '=', 'Administrator');
        })->whereNotIn('id', [14])->get();

        $user_author = User::whereHas('role', function ($query) {
            $query->where('name', '=', 'Author');
        })->whereNotIn('id', [14])->get();

        $user_subs = User::whereHas('role', function ($query) {
            $query->where('name', '=', 'Subscriber');
        })->whereNotIn('id', [14])->get();


        $search = $request->input('search');
        $role   = $request->input('role');

        if ($search != null)
        {
            $users = User::SearchByKeyword($search)->whereNotIn('id', [14])->orderBy('id', 'desc')->paginate(10);
            $param = 'search';
            $param_val = $search;
        }
        elseif ($role != null)
        {
            switch($role)
            {
                case 'administrator':
                    $users= User::whereHas('role', function ($query) {
                        $query->where('name', '=', 'Administrator');
                    })->whereNotIn('id', [14])->paginate(10);
                    break;

                case 'author':
                    $users= User::whereHas('role', function ($query) {
                        $query->where('name', '=', 'Author');
                    })->whereNotIn('id', [14])->paginate(10);
                    break;

                case 'subscriber':
                    $users= User::whereHas('role', function ($query) {
                        $query->where('name', '=', 'Subscriber');
                    })->whereNotIn('id', [14])->paginate(10);
                    break;

                default:
                    break;
            }

            $param = 'role';
            $param_val = $role;
        }

        else
        {
            $users = User::whereNotIn('id', [14])->orderBy('id', 'desc')->paginate(10);
            $param = null;
            $param_val = null;
        }

        return view('admin.users.index', compact('users', 'user_all', 'user_admin', 'user_author', 'user_subs', 'roles', 'param', 'param_val'));
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
            Comment::where('user_id', '=', $id)->delete();
            CommentReply::where('user_id', '=', $id)->delete();

            $user->delete();
            return redirect('/admin/users')->with('status', 'User deleted!');
        } else {
            return redirect('/admin/users')->with('status', 'This user cannot be deleted!');
        }

    }


    public function bulkActions(Request $request)
    {
        $input = $request->all();
        $roles = Role::all();

        if(isset($input['checkboxUsersArray']))
        {

            $user_count = count($input['checkboxUsersArray']);

            foreach ($roles as $role)
            {
                if (isset($input[$role->name]))
                {
                    User::whereIn('id', $input['checkboxUsersArray'])->update(['role_id' => $role->id]);

                    if ($user_count == 1) {
                        $status = $user_count . ' user updated!';
                    } else {
                        $status = $user_count . ' users updated!';
                    }

                }

            }

            if (isset($input['delete']))
            {
                foreach($input['checkboxUsersArray'] as $id) {
                    Comment::where('user_id', '=', $id)->delete();
                    CommentReply::where('user_id', '=', $id)->delete();
                    Post::where('user_id', '=', $id)->update(['user_id' => 14]);
                }

                User::whereIn('id', $input['checkboxUsersArray'])->delete();

                if ($user_count == 1) {
                    $status = $user_count . ' user deleted!';
                } else {
                    $status = $user_count . ' users deleted!';
                }
            }

            return redirect('/admin/users')->with('status', $status);

        }

        else
        {
            return redirect('/admin/users');
        }

    }

}
