<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'nit' => ['required', 'string', 'max:255', 'unique:companies'],
            'nameCompany' => ['required', 'string', 'max:50', 'unique:companies'],
            'descriptionCompany' => ['required', 'string', 'max:225'],
            'numberCompany' => ['required', 'string', 'max:11'],
            'industryCompany' => ['required', 'string', 'max:50'],
            'LocationCompany' => ['required', 'string', 'max:100'],
            'photo_logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ];
    }
}
