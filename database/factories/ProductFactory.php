<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $arr = [50,100,150,200,250,300,350,400,450];
        return [
            'title' => $this->faker->unique()->word(10),
            'price' => $this->faker->randomElement($arr),
        ];
    }
}
