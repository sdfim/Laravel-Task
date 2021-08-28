<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Position;


class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positionLevel = Position::select('id')->where('level', '=', 5);

        Employee::factory()->create([
            'id' => 1,
            'head_id' => 1,
            'position_id' => $positionLevel->inRandomOrder()->get()[0]->id,
        ]);

        for ($i = 5; $i >= 1; $i--) {
            $positionLevel = Position::where('level', '=', $i)->get()->toArray();
            $employeeIds = Employee::select('id')->get()->toArray();
            $d = round(22000/$i);
            for ($j = 1; $j <= $d; $j++){
                Employee::factory()->create([
                    'head_id' => $employeeIds[array_rand($employeeIds, 1)]['id'],
                    'position_id' => $positionLevel[array_rand($positionLevel, 1)]['id']
                ]);
            }
        }
    }
}
