<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "path" => $this->faker->unique()->randomElement([
                'media/exmaple1.png',
                'media/exmaple2.png',
                'media/exmaple3.png',
                'media/exmaple4.png',
                'media/exmaple5.png',
                'media/exmaple6.png',
                'media/exmaple7.png',
                'media/exmaple8.png',
                'media/exmaple9.png',
                'media/exmaple10.png',
                'media/exmaple11.png',
                'media/exmaple12.png',
            ])
        ];
    }
}
