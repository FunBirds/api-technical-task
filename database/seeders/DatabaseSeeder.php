<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Company::factory()
            ->create();

        // Create users and associate them with the created company
        User::factory(10)
            ->create([
                'u_company_id' => 1,
            ]);

        Admin::factory()
            ->create();
    }
}
