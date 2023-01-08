<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = ['active', 'passive'];
        $title = $this->faker->unique()->sentence(rand(3, true));
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'category_id'=> rand(1,25),
            'description' => $this->faker->paragraph,
            'status' => $status[rand(0, 1)],
            'price' => $this->faker->randomFloat(2, 1, 100),
            'quantity' => $this->faker->numberBetween(0, 100),
            'image' => $this->faker->imageUrl(640, 480),
        ];
    }
}
