<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
        return [
            'archived' => 'int|nullable',
            'created_at' => 'date|nullable',
            'created_at_after' => 'date|nullable',
            'created_at_before' => 'date|nullable',
            'category_id' => 'int|nullable',
            'deletecriteria_id' => 'int|nullable',
        ];
    }
}
