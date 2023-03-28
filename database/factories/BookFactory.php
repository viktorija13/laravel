<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $numberOfWords = fake()->randomDigit() + 1;
        return [
            'title' => fake()->sentence($numberOfWords, true),
            'abstract' => fake()->text(255),
            'year' => fake()->numberBetween(1400, date("Y"))
        ];
    }
}
