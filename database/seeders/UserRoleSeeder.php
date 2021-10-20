<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('email','admin@test.com')->first();
        $admin->assignRole('admin');

        $pramuniaga = User::where('email','pramuniaga@test.com')->first();
        $pramuniaga->assignRole('pramuniaga');

        $payment = User::where('email','payment@test.com')->first();
        $payment->assignRole('payment');

        $dev = User::where('email','dev@test.com')->first();
        $dev->assignRole('dev');
    }
}
