<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'director' => $this->faker->name(),
            'year' => $this->faker->year(),
            'poster' => $this->faker->image(),
            'rented' => $this->faker->boolean(),
            'synopsis' => $this->faker->text(),
        ];
    }
}
