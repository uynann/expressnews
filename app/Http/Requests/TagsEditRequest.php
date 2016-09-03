<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Tag;

class TagsEditRequest extends Request
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
        $tag = Tag::find($this->tags);

        return [
            'name' => 'required|max:255|unique:tags,name,' . $tag->id,
            'slug'  => 'required|max:255|unique:tags,slug,' . $tag->id,
        ];
    }
}
