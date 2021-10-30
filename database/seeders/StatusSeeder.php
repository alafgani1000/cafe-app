<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $active = Status::create([
            'name' => 'Active'
        ]);

        $inactive = Status::create([
            'name' => 'In Active'
        ]);
    }
}
