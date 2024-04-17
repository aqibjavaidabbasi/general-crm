<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentSettingRequest extends FormRequest
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
            'allow_comments' => 'nullable|boolean',
            'require_name_email' => 'nullable|boolean',
            'require_registration' => 'nullable|boolean',
            'close_days' => 'nullable|integer|min:1',
            'nested_levels' => 'required|integer|min:2|max:10',
            'per_page' => 'required|integer|min:1',
            'order' => 'required|in:newer,older',
            'email_on_comment' => 'nullable|boolean',
            'moderation' => 'nullable|boolean',
            'manual_approval' => 'nullable|boolean',
            'previous_approval' => 'nullable|boolean',
            'links_threshold' => 'required|integer|min:1',
            'hold_keywords' => 'nullable|string',
            'disallowed_keywords' => 'nullable|string',
            'display_avatars' => 'nullable|boolean',
            'default_avatar' => 'required|in:mystery,blank,gravatar,identicon,wavatar,monsterid,retro',
        ];
    }
}
