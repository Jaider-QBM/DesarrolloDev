<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:225'],
            'phone_number' => ['required', 'string', 'max:11'],
            'document_type' => ['required', 'string', 'max:225'],
            'document_number' => ['required', 'string', 'max:15', 'min:5', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string']
        ];
    }
}
