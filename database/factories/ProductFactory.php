<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'imagePath' =>'https://source.unsplash.com/random',
            'title' => 'HP 15-da0503sa 15.6'.$this->faker->isbn10(),
            'description' =>$this->faker->paragraph($nb =8),
            'price' =>$this->faker->numberBetween($min = 500, $max = 8000)

        ];
    }
}
