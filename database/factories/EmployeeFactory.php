<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $admin_add = rand(10000000, 99999999);
        return [
            'name' => $this->faker->firstName(). " " . $this->faker->lastName(),
            'phone' => '+380 ('. $this->faker->randomElement([39, 50, 63, 66, 67, 68, 73, 91, 92, 93, 94, 95, 96, 97, 98, 99]) . ') ' . $this->faker->unique()->numerify('### ## ##'),
            'email' => $this->faker->unique()->freeEmail(),
            'salary' => rand(1000, 7000),
            'date_employment' => $this->faker->dateTimeBetween('-500 days', '0 days'),
            'admin_created_id' => $admin_add,
            'admin_updated_id' => $admin_add,
        ];
    }
}
