<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $devRoles = [
            'Junior Frontend Developer',
            'Senior Frontend Developer',
            'Junior Backend Developer',
            'Senior Backend Developer',
            'Full Stack Developer',
            'Laravel Developer',
            'PHP Developer',
            'Node.js Developer',
            'React Developer',
            'Software Engineer',
        ];

        $annualSalaryUsd = fake()->numberBetween(45, 180) * 1000;

        return [
            'employer_id' => Employer::factory(),
            'title' => fake()->randomElement($devRoles),
            'salary' => number_format($annualSalaryUsd, 0, ',', ' ') . ' USD/year',
            'location' => fake()->randomElement(['Lisboa', 'Porto', 'Braga', 'Remote', 'Hibrido']),
            'schedule' => fake()->randomElement(['full-time', 'part-time', 'contract']),
            'url' => fake()->url,
            'feature' => fake()->boolean(30),
        ];
    }
}
