<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'slug' => 'sometimes',
            'parent_id' => 'sometimes',
            'description' => 'sometimes',
            'meta_title' => 'sometimes',
            'meta_description' => 'sometimes',
            'meta_media_id' => 'sometimes',
        ];
    }
}
