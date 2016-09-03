<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Post;

class PostsEditRequest extends Request
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
        $post = Post::find($this->posts);

        return [
            'title' => 'required|max:255|unique:posts,title,' . $post->id,
            'slug'  => 'required|max:255|unique:posts,slug,' . $post->id,
        ];
    }
}
