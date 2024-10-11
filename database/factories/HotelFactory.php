<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ratehawk_id' => null,
            'name' => 'A Disney Hotel',
            'category' => 'value',
            'stars' => 2,
            'has_bus' => true,
            'has_skyliner' => false,
            'has_boat' => false,
            'area_description' => '',
            'description' => ''
        ];
    }
}
