<?php

namespace Database\Factories;

use App\Models\Division;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'division_id' => Division::factory(),
            'job_id' => Job::factory(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber()
        ];
    }
}
