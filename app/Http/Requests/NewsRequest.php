<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'news.*.category_id' => 'required|int|exists:categories,id',
            'news.*.title' => 'required|string|max:255',
            'news.*.body' => 'required|string|max:65000',
            'news.*.event' => 'string|max:65000',
            'news.*.location' => 'string|max:65000',
        ];
    }
}
