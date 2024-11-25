<?php

declare(strict_types=1);

namespace Database\Factories;

use App\ValueObjects\NumberWithNegativeValues as Number;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OperationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => Number::make(rand(500, 10000)),
            'description' => fake()->text,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function spending(): static
    {
        return $this->state(fn (array $attributes) => [
            'amount' => Number::make(rand(-100, -1)),
        ]);
    }
}
