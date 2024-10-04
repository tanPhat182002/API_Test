<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
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
    public function definition(): array
    {
        $product=['quần jean','balo gucci','mũ lưỡi trai', 'túi xách'];
        
        return [
            'name' => $this->faker->unique()->randomElement($product),
            'price' => $this->faker->numberBetween(100000, 1000000),
            'category_id' => Category::inRandomOrder()->first()->id, // Lấy ngẫu nhiên 1 category_id từ bảng categories
            'description' => $this->faker->text(200),
            'image' => $this->faker->imageUrl(640, 480, 'product', true),
        ];
    }
}
