<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|string',
            'subcategory_id' => 'required|not_in:0',
            'price' => 'required|min:0',
            'thumbnail' => 'required | mimes:jpeg,jpg,png | max:3072',
        ];
    }
}
