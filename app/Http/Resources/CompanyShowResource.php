<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->c_name,
            "owner" => $this->c_owner,
            "address" => $this->c_address,
            "email" => $this->c_email,
            "website" => $this->c_website,
            "logo" => $this->c_logo,
            "phone" => $this->c_phone,
            "users" => $this->users->map(function ($user) {
                return [
                    "user_passport" => $user->u_passport,
                    "user_name" => $user->u_name,
                    "user_surname" => $user->u_surname,
                    "user_middle_name" => $user->u_middle_name,
                    "user_position" => $user->u_position,
                    "user_phone" => $user->u_phone,
                    "user_address" => $user->u_address,
                ];
            })
        ];
    }
}
