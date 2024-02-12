<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'username' => 'admin1',
            'password' => bcrypt('12345'),
            'email' => 'admin1@gmail.com',
            'namalengkap' => 'admin_satu',
            'alamat' => 'Tambakdahan',
            'role' => 'administrator'
        ]);
    }
}
