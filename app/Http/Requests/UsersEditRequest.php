<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;

class UsersEditRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $user = User::find($this->users);
        return [
            //
            'firstname' => 'max:255',
            'lastname' => 'max:255',
            'username' => 'required|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' .$user->id,
            'password' => 'min:6|confirmed',
        ];
    }
}
