<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $developer = Role::create(['name' => 'dev']);
        $payment = Role::create(['name' => 'payment']);
        $pramuniaga = Role::create(['name' => 'pramusaji']);
        $guest = Role::create(['name' => 'guest']);
    }
}
