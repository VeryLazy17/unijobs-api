<?php

namespace Database\Seeders;

use App\Models\Factory_category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class Factory_categorySeeder extends Seeder
{
    public function run()
    {
        Factory_category::insert([
            [
                'id' => 1,
                'name' => 'Mato to\'quv fabrika',
                'description' => 'Mato to\'quv fabrikasi.',
                'type' => 'material',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Yoqa to\'quv fabrika',
                'description' => 'Yoqa to\'quv fabrika.',
                'type' => 'collar',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'Bo\'yoqxona',
                'description' => 'Bo\'yash ishlari olib boriladi.',
                'type' => 'paint',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => 'Fabrika',
                'description' => 'Fabrika.',
                'type' => 'factory',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
