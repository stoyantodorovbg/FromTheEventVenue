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
        $news_id = $this->isMethod('PATCH') ? $this->route('news')->id : '';

        return [
            'news' => 'required|array|min:1',
            'news.*.category_id' => 'required|int|exists:categories,id|min:1',
            'news.*.title' => 'required|string|max:255|unique:news,title,' . $news_id,
            'news.*.body' => 'required|string|max:65000',
            'news.*.event' => 'string|max:65000|nullable',
            'news.*.location' => 'string|max:65000|nullable',
        ];
    }
}
