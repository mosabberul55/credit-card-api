<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate(['phone' => '01711111111', 'email' => 'admin@example.com'], [
            'name' => 'admin',
            'phone' => '01711111111',
            'password' => bcrypt('secret'),
            'type' => 'admin'
        ]);
        $user = User::updateOrCreate(['phone' => '01722222222', 'email' => 'admin@employee.com'], [
            'name' => 'employee',
            'phone' => '01722222222',
            'password' => bcrypt('secret'),
            'type' => 'employee'
        ]);
    }
}
