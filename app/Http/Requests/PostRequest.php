<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        // request()
        return [
            'title' => 'required|min:5',
            'preview' => 'required|max:200',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'sometimes',
            'attachment' => 'sometimes',
        ];
    }
}
