<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeName;


class EmployeeNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeeName::factory()->count(50000)->create();
    }
}
