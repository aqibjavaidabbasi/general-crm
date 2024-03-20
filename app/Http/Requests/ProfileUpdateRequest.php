<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'name' => 'string | required | max:255',
            'email' => 'required | string | email | max:255',
            'password' => 'nullable | confirmed | string | min:8'


        ];
    }

    public function prepareForValidation()
    {
        if($this->password == null) {
            $this->request->remove('password');
        }
    }
}
