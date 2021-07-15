<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
        for($i = 1; $i <= 50; $i++){
 
              // insert data ke table 
            DB::table('siswa')->insert([
                'nis' => $faker->unique()->numberBetween(202008,202100),
                'nama' => $faker->name,
                'tgl_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'telp' => $faker->phoneNumber,
                'alamat' => $faker->address,
                'kd_kelas' => $faker->numberBetween(1,2)
            ]);
 
        }
    }
}
