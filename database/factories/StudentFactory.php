<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_id' => Department::factory(),
            'student_code' => 'STU-'.fake()->unique()->numerify('####'),
            'name' => fake()->name(),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'dob' => fake()->dateTimeBetween('-25 years', '-18 years')->format('Y-m-d'),
            'phone' => fake()->numerify('+855 1# ### ###'),
        ];
    }
}
