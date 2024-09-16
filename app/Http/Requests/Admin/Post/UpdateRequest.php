<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string|max:255', 
            'content' => 'required|string',
            'preview_image' => 'nullable|image',
            'main_image' => 'nullable|image',
            'category_id' => 'required|integer|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|integer|exists:tags,id'
        ];
    }


    public function messages(): array
    {
        return [
            'title.required' => 'This field is required',
            'title.string' => 'The title must be a string',
            'title.max' => 'The title may not be greater than 255 characters',
            'content.required' => 'This field is required',
            'content.string' => 'The content must be a string',
            'preview_image.image' => 'The preview image must be an image',
            'main_image.image' => 'The main image must be an image',
            'category_id.required' => 'This field is required',
            'category_id.exists' => 'The category does not exist',
            'tag_ids.array' => 'The tag ids must be an array',
            'tag_ids.*.exists' => 'The tag does not exist'
        ];
    }
}
