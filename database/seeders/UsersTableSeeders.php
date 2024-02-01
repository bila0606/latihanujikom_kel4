<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Iluminate\Support\Facades\DB;
use Iluminate\Support\facades\Hash;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //memasukan data
        DB::table('users')->insert([
            'name' => 'Karin',
            'email' => 'karin@gmail.com',
            'password' =>Hash::make('123456')
        ]);
    }
}
