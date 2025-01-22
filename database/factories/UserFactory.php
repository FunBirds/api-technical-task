<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            "u_passportNumber" => $this->faker->unique()->randomNumber(8),
            "u_name" => $this->faker->name,
            "u_surname" => $this->faker->lastName,
            "u_middle_name" => $this->faker->firstName,
            "u_position" => $this->faker->jobTitle,
            "u_phone" => $this->faker->phoneNumber,
            "u_address" => $this->faker->address,
            "remember_token" => Str::random(),
        ];
    }
}
