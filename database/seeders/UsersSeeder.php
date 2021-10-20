<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // user example
         $payment = User::create([
            'name' => 'Payment',
            'email' => 'payment@test.com',
            'password' => Hash::make('payment')
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin')
        ]);

        $pramuniaga = User::create([
            'name' => 'Pramuniaga',
            'email' => 'pramuniaga@test.com',
            'password' => Hash::make('pramuniaga')
        ]);

        $developer = User::create([
            'name' => 'Dev',
            'email' => 'dev@test.com',
            'password' => Hash::make('dev')
        ]);
        
    }
}
