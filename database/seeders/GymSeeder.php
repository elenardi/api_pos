<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gyms =[
            [
                'gym_name' => 'Gatsu Barat',
            ],
            [
                'gym_name' => 'Satria',
            ],
            [
                'gym_name' => 'Batu Bulan',
            ],
            [
                'gym_name' => 'Canggu',
            ],
            [
                'gym_name' => 'Malboro',
            ],
            [
                'gym_name' => 'Jimbarat',
            ],
        ];
        DB::table('gyms')->insert($gyms);
    }
}
