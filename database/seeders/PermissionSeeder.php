<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $subjects = ['sidebar_finance', 'navbar_finance'];
//        $actions = 'read|update|delete';
//
//        foreach ($subjects as $subject) {
//            DB::table('permissions')->insert([
//                'action' => $actions,
//                'subject' => $subject,
//                'role_id' => 1,
//            ]);
//        }

        DB::table('permissions')->insert([
            'action' => 'manage',
            'subject' => 'all',
            'role_id' => 1,
        ]);
    }
}
