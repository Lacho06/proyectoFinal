<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CulturalWork>
 */
class CulturalWorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'year_of_stablishment' => $this->faker->year(),
            'restore_permission' => $this->faker->randomElement(['autor','universidad','no']),
            'location' => $this->faker->sentence(),
            'review' => $this->faker->paragraph(),
            'state_of_disrepair' => $this->faker->randomElement(['óptimo','regular','deteriorado']),
            'budget' => $this->faker->randomFloat()
        ];
    }
}
