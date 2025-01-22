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
            "name"=>$this->c_name,
            "owner"=>$this->c_owner,
            "address"=>$this->c_address,
            "email"=>$this->c_email,
            "website"=>$this->c_website,
            "logo"=>$this->c_logo,
            "phone"=>$this->c_phone,
        ];
    }
}
