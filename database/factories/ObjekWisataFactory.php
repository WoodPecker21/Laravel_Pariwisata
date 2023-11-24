<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ObjekWisata>
 */
class ObjekWisataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word,
            'deskripsi' => $this->faker->paragraph,
            'kategori' => '',
            'gambar' => '',
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'harga' => $this->faker->numberBetween(100000, 999999) * 1000,
            'pulau' => '',
            'durasi' => $this->faker->numberBetween(1, 99),
            'akomodasi' => $this->faker->word,
            'transportasi' => $this->faker->word,
        ];
    }
}
