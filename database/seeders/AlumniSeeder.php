<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AlumniSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = Faker::create();

    foreach (range(1, 20) as $index) {
      DB::table('alumnis')->insert([
        'nama' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'nim' => $faker->unique()->numerify('##########'),
        'jenis_kelamin' => $faker->randomElement(['L', 'P']),
        'tempat_lahir' => $faker->city,
        'tanggal_lahir' => $faker->date('Y-m-d', '-20 years'),
        'alamat' => $faker->address,
        'no_telepon' => $faker->phoneNumber,
        'foto' => $faker->imageUrl(640, 480, 'people'),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
