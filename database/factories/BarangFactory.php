<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $beli = fake()->numberBetween(10, 100) * 1000;
        $jual = $beli * fake()->randomFloat(2, 1, 2);

        return [
            'name' => fake()->words(2, true),
            'stok' => fake()->numberBetween(5, 50),
            'gambar' => 'https://placehold.co/600x400',
            'harga_beli' => $beli,
            'harga_jual' => $jual,
        ];
    }
}
