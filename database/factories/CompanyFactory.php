<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "c_name" => $this->faker->company,
            "c_owner" => $this->faker->name,
            "c_address" => $this->faker->address,
            "c_email" => $this->faker->unique()->safeEmail,
            "c_website" => $this->faker->url,
            "c_logo" => $this->faker->imageUrl(),
            "c_phone" => $this->faker->phoneNumber,
            "remember_token" => Str::random(),
            "c_password" => Hash::make("password"),
        ];
    }
}
