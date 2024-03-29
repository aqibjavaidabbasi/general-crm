<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'sometimes',
            'content' => 'sometimes',
            'visibility' => 'sometimes',
            'blog-media-id' => 'sometimes',
            'protection-password' => 'sometimes',
            'status' => 'sometimes',
            'front-page-blog' => 'sometimes',
            'files' => 'sometimes',
            'meta_title' => 'sometimes',
            'meta_description' => 'sometimes',
            'published_date_time' => 'sometimes',
            'format' => 'sometimes|in:standard,audio,video,gallery',
            'category_ids' => 'sometimes|array',
            'category_ids.*' => 'exists:categories,id',
            'tag_ids' => 'sometimes|array',
            'tag_ids.*' => 'exists:tags,id',
            'featured' => 'sometimes|boolean',
        ];
    }
}
