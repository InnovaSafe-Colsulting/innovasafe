<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            CitySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            TypeServiceSeeder::class,
            ConfigurationCompanySeeder::class,
            NavigationMenuSeeder::class,
            TypePaymentSeeder::class,
            TypePaymentDetailSeeder::class,
        ]);
    }
}
