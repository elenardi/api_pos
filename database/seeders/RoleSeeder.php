<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles =[
            [
                'role_name' => 'Admin',
            ],
            [
                'role_name' => 'Personal Trainer',
            ],
            [
                'role_name' => 'Karyawan',
            ],
            [
                'role_name' => 'Member',
            ],
        ];
        DB::table('roles')->insert($roles);
    }
}
