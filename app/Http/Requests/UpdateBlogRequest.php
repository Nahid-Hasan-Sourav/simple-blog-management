<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>['string','max:255'],
            'description'=>['string'],
            'image'=>['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'feature_images'=>['array'],
            'feature_images.*'=>['image'],
        ];
    }
}
