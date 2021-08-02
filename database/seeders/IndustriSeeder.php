<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class IndustriSeeder extends Seeder
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
            DB::table('industri')->insert([
                'nama' => $faker->company,
                'bidang_kerja' => $faker->jobTitle,
                'deskripsi' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'alamat' => $faker->address,
                'wilayah' => $faker->country
            ]);
 
        }
    }
}
