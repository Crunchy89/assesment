<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->firstName(),
            'tanggal_masuk' => $this->faker->dateTimeBetween('-3 years', '-1 years'),
            'total_gaji' => $this->faker->randomFloat(0, 4000000, 100000000),
        ];
    }
}
