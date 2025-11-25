<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        $category = $this->faker->randomElement([
            'skincare',
            'fragrance',
            'eyes',
            'lips',
            'body',
        ]);

        return [
            'name'        => $name,
            'slug'        => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'description' => $this->faker->sentence(12),
            'price'       => $this->faker->numberBetween(5000, 25000), // cents
            'image_url'   => 'https://picsum.photos/seed/' . $this->faker->unique()->numberBetween(1, 1000) . '/600/600',
            'rating'      => $this->faker->numberBetween(1, 5),
            'category'    => $category,
        ];
    }
}
