<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $faker = Faker::create();

        $gender = $faker->randomElement(['male', 'female']);

        foreach (range(1, 50) as $index) {
            DB::table('nisans')->insert([
                'nomor' => $faker->numberBetween($min = 1000, $max = 9000),
                'nama' => $faker->name($gender),
                'tanggal' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'gereja' => $faker->city,
                'blok_nomor_nisan' => $faker->randomDigit,
                'nama_nomor_keluarga' => $faker->phoneNumber,
                'email' => $faker->email,
                'pembayaran_terakhir' => $faker->date($format = 'Y-m-d'),
                'image' => $faker->imageUrl($width = 640, $height = 480)
            ]);
        }
    }
}
