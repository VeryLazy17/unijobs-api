<?php

namespace Database\Seeders;

use App\Models\Storage_type;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class Storage_typeSeeder extends Seeder
{
    public function run()
    {
        Storage_type::insert([
            [
                'id' => 1,
                'name' => 'Xomashyo sklad',
                'type' => 'raw',
                'description' => 'Xomashyo sklad',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Ta\'minot sklad',
                'type' => 'provider',
                'description' => 'Ta\'minot skladda 2 xil xolatda mahsulot saqlanadi. Bo\'yalgan va bichilgan.',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'Tayyor sklad',
                'type' => 'ready',
                'description' => 'Tayyor mahsulotlar saqlanadi. Sotuvga tayyor.',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
