<?php

namespace Database\Factories;

use App\Models\Dog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dog>
 */
class DogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'data' => json_encode([
                'age' => fake()->numberBetween(0, 15),
                'breed' => optional(fake()->boolean(), fn() => fake()->name)
            ])
        ];
    }

    public function customName(string $name): static
    {
        return $this->state(
            fn (array $attributes): array => [
                'name' => $name
            ],
        );
    }
}
