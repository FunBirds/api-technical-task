<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name"=>["sometimes", "string", "max:255"],
            "owner"=>["sometimes", "string", "max:255"],
            "address"=>["sometimes", "string", "max:255"],
            "email"=>["sometimes", "string", "email", "max:255"],
            "website"=>["sometimes", "string", "max:255"],
            "logo"=>["sometimes", "file", "max:5120"],
            "phone"=>["sometimes", "string", "max:255"],
            "password"=>["sometimes", "string", "max:255", "min:8"],
        ];
    }
}
