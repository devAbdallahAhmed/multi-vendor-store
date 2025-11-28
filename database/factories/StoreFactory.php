<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{

    public function definition(): array
    {
        $name = $this->faker->words(2, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
          'logo_image' => 'https://picsum.photos/300/300?random=' . rand(1, 1000),
'cover_image' => 'https://picsum.photos/800/600?random=' . rand(1, 1000),

            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
