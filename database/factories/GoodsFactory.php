<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Goods>
 */
class GoodsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'sub_name' => fake()->word(),
            'price' => mt_rand(10, 9999),
            'cost_price' => mt_rand(10, 9999),
            'stock' => mt_rand(100, 9999),
            'sort' => mt_rand(1, 100),
            'is_show' => mt_rand(0, 1),
        ];
    }
}
