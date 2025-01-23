<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name"=>$this->u_id,
            "surname"=>$this->u_surname,
            "middle_name"=>$this->u_middle_name,
            "position"=>$this->u_position,
            "phone"=>$this->u_phone,
            "address"=>$this->u_address,
            "company_id"=>$this->u_company_id
        ];
    }
}
