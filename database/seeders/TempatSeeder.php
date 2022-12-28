<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tempat;

class TempatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tempat::create([
            'nama_tempat' => 'Kampung Cai Ranca Upas',
            'alamat' => 'Jl. Raya Ciwidey - Patengan No. KM. 11, Patengan, Kec. Rancabali, Bandung, Jawa Barat 40973',
            'latitude' => '-7.13236278038796',
            'longitude' => '107.41843700408937',
            'deskripsi' => ' adalah salah satu tempat wisata paling menarik di Ciwidey! Selain punya area perkemahan yang cantik, Kampung Cai Ranca Upas juga punya  yang menyenangkan untuk dikunjungi. Selain itu juga ada berbagai permainan outbound yang bisa kamu coba di sana bersama keluarga.
            Eh, di sini ada kolam pemandian air panas alaminya juga, lho!',
            'jam_buka' => '00:00',
            'jam_tutup' => '24:00',
            'hari_buka' => 'Senin',
            'hari_tutup' => 'Minggu',
            'harga_tiket' => 25000
        ]);

        Tempat::create([
            'nama_tempat' => 'Museum Sri baduga',
            'alamat' => 'Jl. BKR No.185, Pelindung Hewan, Kec. Astanaanyar, Kota Bandung, Jawa Barat 40243',
            'latitude' => '-6.921996203636636',
            'longitude' => '107.66258239746095',
            'deskripsi' => 'Didirikan tahun 1974, museum diresmikan pada 1980 dengan nama Museum Negeri Provisi Jawa Barat oleh Menteri Pendidikan dan Kebudayaan, Dr Daud Yusuf. Di tahun 1990, museum ini berubah nama menjadi Museum Negeri Provinsi Jawa Barat Sri Baduga. Sri Baduga ialah nama seorang Raja Agung kerajaan Sunda yang beragama Hindu di Jawa Barat. Koleksi pada Museum Sri Baduga banyak memamerkan berbagai macam benda bersejarah dan benda antik yang bernilai seni tinggi. Beragam benda tersebut terdiri dari beberapa koleksi, seperti koleksi arca pada zaman megalitik, pakaian adat, rumah, perkakas, permainan, dan alat musik tradisional.',
            'jam_buka' => '08:00',
            'jam_tutup' => '16:00',
            'hari_buka' => 'Selasa',
            'hari_tutup' => 'Jum\'at',
            'harga_tiket' => 3000
        ]);
    }
}
