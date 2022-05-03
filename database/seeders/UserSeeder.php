<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Emiran group',
            'email' => 'emiran@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'mr.sodiqmirzosattorov@gmail.com',
            'password' => Hash::make('emiran'),
            'role_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Sotuvchi',
            'email' => 'seller@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => 2,
        ]);
    }
}
