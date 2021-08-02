<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WaliSeeder extends Seeder
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
            DB::table('wali_kelas')->insert([
                'nama' => $faker->name,
                'telp' => $faker->phoneNumber
            ]);
        }
    }
}
