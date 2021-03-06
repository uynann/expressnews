<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Category;

class CategoriesEditRequest extends Request
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
        $category = Category::find($this->categories);

        return [
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'slug'  => 'required|max:255|unique:categories,slug,' . $category->id,
        ];
    }
}
