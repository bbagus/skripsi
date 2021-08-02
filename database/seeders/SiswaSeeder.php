<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

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

            $nis = $faker->unique()->numberBetween(202008,202100);
            $tgl = $faker->date($format = 'Y-m-d', $max = 'now');
            $ambil = strtotime($tgl);
            $psw = date('dmY',$ambil);
            $psw = Hash::make($psw);
            DB::table('users')->insert([
                'username' => $nis,
                'password' => $psw,
                'role' => 'siswa'
            ]);
 
              // insert data ke table 
            DB::table('siswa')->insert([
                'nis' => $nis,
                'nama' => $faker->name,
                'tgl_lahir' => $tgl,
                'telp' => $faker->phoneNumber,
                'alamat' => $faker->address,
                'kd_kelas' => $faker->numberBetween(1,11)
            ]);
 
        }
    }
}
