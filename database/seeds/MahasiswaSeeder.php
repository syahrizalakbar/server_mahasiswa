<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 50;$i++) {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->nama = $faker->name;
            $mahasiswa->telp = $faker->phoneNumber;
            $mahasiswa->alamat = $faker->address;
            $mahasiswa->save();
        }
    }
}
