<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;
    protected $guarded = ["c_id"];
    protected $primaryKey = "c_id";
    public function users(): HasMany
    {
        return $this->hasMany(User::class, "u_company_id", "c_id");
    }
}
