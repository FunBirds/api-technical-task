<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyUserRequest extends FormRequest
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
            "passportNumber" => ["sometimes", "string", "max:255"],
            "name" => ["sometimes", "string", "max:255"],
            "surname" => ["sometimes", "string", "max:255"],
            "middle_name" => ["sometimes", "string", "max:255"],
            "position" => ["sometimes", "string", "max:255"],
            "phone" => ["sometimes", "string", "max:255"],
            "address" => ["sometimes", "string", "max:255"],
            "company_id" => ["sometimes", "integer", "exists:companies,c_id"],
        ];
    }
}
