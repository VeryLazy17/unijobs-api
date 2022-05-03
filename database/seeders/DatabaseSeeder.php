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
        $this->call([
            Product_categorySeeder::class,
//            ProductSeeder::class,
            Storage_typeSeeder::class,
            Factory_categorySeeder::class,
            FactorySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
        ]);
    }
}
