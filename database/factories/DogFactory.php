<?php

namespace Database\Factories;

use App\Enums\FoodCatalog;
use App\Models\Dog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dog>
 */
class DogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'favorite_food' => Arr::random([FoodCatalog::BACON, FoodCatalog::KIBBLES, FoodCatalog::MEATBALLS]),
            'weight' => fake()->numberBetween(Dog::WEIGHT_MIN,Dog::WEIGHT_MAX),
            'teeth' => Dog::ADULT_DOG_TEETH_COUNT,
        ];
    }

}
