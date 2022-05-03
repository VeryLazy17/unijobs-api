<?php

namespace Database\Seeders;

use App\Models\Product_category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class Product_categorySeeder extends Seeder
{
    public function run()
    {
        Product_category::insert([
            [
                'id' => 1,
                'name' => 'Ip',
                'parent_id' => null,
                'description' => 'ip mahsulotlari.',
                'type' => 'thread',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Mato',
                'parent_id' => null,
                'description' => 'Mato mahsulotlari.',
                'type' => 'material',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'Yoqa',
                'parent_id' => null,
                'description' => 'Yoqa mahsulotlari.',
                'type' => 'collar',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => 'Aksessuar',
                'parent_id' => null,
                'description' => 'Aksessuar mahsulotlari.',
                'type' => 'accessory',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => 'Tayyor mahsulot',
                'parent_id' => null,
                'description' => 'Sotuvga tayyor mahsulotlar.',
                'type' => 'product',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'name' => 'Vilvit',
                'parent_id' => 2,
                'description' => null,
                'type' => 'null',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'name' => 'Manjet',
                'parent_id' => 3,
                'description' => null,
                'type' => 'null',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'name' => 'Tugma',
                'parent_id' => 4,
                'description' => null,
                'type' => 'null',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 9,
                'name' => 'Qishgi',
                'parent_id' => 5,
                'description' => null,
                'type' => 'null',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 10,
                'name' => 'Yozgi',
                'parent_id' => 5,
                'description' => null,
                'type' => 'null',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
