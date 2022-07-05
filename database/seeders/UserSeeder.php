<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Admin",
            'lastname' => 'admin',
            'email' => "admin@edraakmc.com",
            'is_admin' => 1,
            'password' => bcrypt('edraakdMC_admin'),
        ]);

        User::create([
            'name' => "Customer",
            'lastname' => 'test',
            'email' => "customer@edraakmc.com",
            'is_admin' => 0,
            'status' => 1,
            'password' => bcrypt('12345678$$'),
        ]);
    }
}
