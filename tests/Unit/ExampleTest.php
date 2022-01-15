<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Models\Kasbon;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetPegawai()
    {
        $this->get(route('pegawai'))
            ->assertStatus(200);
    }
    public function testPostPegawai()
    {
        $faker = \Faker\Factory::create();
        $data = [
            'nama' => $faker->firstname(),
            'tanggal_masuk' => $faker->dateTimeBetween('-2 years', '-1 years'),
            'total_gaji' => $faker->randomFloat(0, 4000000, 100000000)
        ];
        $this->post(route('pegawai.store'), $data)
            ->assertStatus(201);
    }
    public function testGetKasbon()
    {
        $this->get(route('kasbon', ['bulan' => '2021-01', 'belum_disetujui' => '', 'page' => '1']))
            ->assertStatus(200);
    }
    public function testPostKasbon()
    {
        $faker = \Faker\Factory::create();
        $data = [
            'pegawai_id' => 1,
            'total_kasbon' => $faker->randomFloat(0, 200000, 2000000)
        ];
        $this->post(route('kasbon.store'), $data)
            ->assertStatus(201);
    }
    public function testPatchKasbon()
    {
        $this->patch(route('kasbon.setujui', 1))
            ->assertStatus(200);
    }
}
