<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyAddUserRequest extends FormRequest
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
            "passportNumber" => ["required", "string", "max:255"],
            "name" => ["required", "string", "max:255"],
            "surname" => ["required", "string", "max:255"],
            "middle_name" => ["required", "string", "max:255"],
            "position" => ["required", "string", "max:255"],
            "phone" => ["required", "string", "max:255"],
            "address" => ["required", "string", "max:255"],
            "company_id" => ["required", "integer", "exists:companies,c_id"],
        ];
    }
}
