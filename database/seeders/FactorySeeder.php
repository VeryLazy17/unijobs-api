<?php

namespace Database\Seeders;

use App\Models\Factory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    public function run()
    {
        Factory::insert([
            [
                'id' => 1,
                'name' => '1-mato to\'quvxonasi',
                'description' => 'Mato to\'quv fabrikasi.',
                'factory_category_id' => '1',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => '2-mato to\'quvxonasi',
                'description' => 'Mato to\'quv fabrikasi.',
                'factory_category_id' => '1',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => '3-mato to\'quvxonasi',
                'description' => 'Mato to\'quv fabrikasi.',
                'factory_category_id' => '1',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => '1-yoqa to\'quvxonasi',
                'description' => 'Yoqa to\'quv fabrika.',
                'factory_category_id' => '2',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => '2-yoqa to\'quvxonasi',
                'description' => 'Yoqa to\'quv fabrika.',
                'factory_category_id' => '2',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'name' => '3-yoqa to\'quvxonasi',
                'description' => 'Yoqa to\'quv fabrika.',
                'factory_category_id' => '2',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'name' => '1-bo\'yoqxona',
                'description' => 'Bo\'yash ishlari olib boriladi..',
                'factory_category_id' => '3',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'name' => '1-fabrika',
                'description' => 'Fabrika.',
                'factory_category_id' => '4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 9,
                'name' => '2-fabrika',
                'description' => 'Fabrika.',
                'factory_category_id' => '4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 10,
                'name' => '3-fabrika',
                'description' => 'Fabrika.',
                'factory_category_id' => '4',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
