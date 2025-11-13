<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(AdminconfigurationwebSeeder::class);
        $this->call(AdminconfigurationkeySeeder::class);
        $this->call(AdminmobileconfigurationSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(ContinentTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);

    }
}
