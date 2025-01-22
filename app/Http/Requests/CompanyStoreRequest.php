<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            "name"=>["required", "string", "max:255"],
            "owner"=>["required", "string", "max:255"],
            "address"=>["required", "string", "max:255"],
            "email"=>["required", "string", "email", "max:255"],
            "website"=>["required", "string", "max:255"],
            "logo"=>["required", "file", "max:5120"],
            "phone"=>["required", "string", "max:255"],
            "password"=>["required", "string", "max:255", "min:8"],
        ];
    }
}
