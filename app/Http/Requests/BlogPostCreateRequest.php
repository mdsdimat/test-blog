<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
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
            'title' => 'required|min:5|max:100',
            'slug' => 'max:100',
            'excerpt' => 'max:500',
            'content_raw' => 'required|string|min:5|max:2000',
            'category_id' => 'required|integer|exists:blog_categories,id',
        ];
    }

    /**
     * Get the messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'content_raw.required' => 'Title is required field!!!!!',
        ];
    }


}
