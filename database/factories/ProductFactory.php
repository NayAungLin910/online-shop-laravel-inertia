<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::all()->random()->id,
            'name' => $this->faker->name(),
            'slug' => rand(1000, 100000), 
            'image' => "image/product.png",
            'description' => $this->faker->text(),
            'view_count' => 100,
            'price' => 100,
        ];
    }
}
