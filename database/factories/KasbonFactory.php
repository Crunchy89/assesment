<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KasbonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'tanggal_diajukan' => $this->faker->dateTimeBetween('-2 months', 'now'),
            'pegawai_id' => $this->faker->numberBetween(1, 10),
            'total_kasbon' => $this->faker->randomFloat(0, 2000000, 4000000),

        ];
    }
}
