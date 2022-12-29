<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(12345678),
            'role' => 1
        ]);

        User::create([
            'name' => 'KhoironyArief',
            'email' => 'khoirony@gmail.com',
            'password' => bcrypt(12345678),
            'role' => 2,
            'jk' => 'Laki-Laki',
            'tempat_lahir' => 'Lamongan',
            'tanggal_lahir' => '01-01-1999',
            'alamat' => 'Jl. Asia Afrika, Balonggede, Kec. Regol, Kota Bandung, Jawa Barat 40251',
            'bio' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        ]);
    }
}
