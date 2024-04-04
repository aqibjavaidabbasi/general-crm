<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required | 255',
            'email' => 'required | email |unique:users,email',
            'password' => 'required | confirmed',
            'name' => 'required',
            'active' => 'required |in:on,off',
            'profile_media_id' => 'sometimes',
            // 'roles' => 'required |array',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Name.',
            'name.max' => 'The Name may not be greater than :max characters.',
            'email.required' => 'Please Enter Email.',
            'email.email' => 'Please Enter a valid Email Address.',
            'email.unique' => 'Provided Email Address Already Exists.',
            'password.required' => 'Please Enter Password.',
            'password.confirmed' => 'The Password confirmation does not match.',
            'active.required' => 'Please Enter Active.',
            'active.boolean' => 'The Active field must be a boolean value.',
        ];
    }
}
