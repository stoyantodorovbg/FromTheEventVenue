<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $category_id = $this->isMethod('PATCH') ? $this->route('category')->id : '';

        return [
            'title' => 'required|string|max:255|unique:categories,title,' . $category_id,
        ];
    }
}
