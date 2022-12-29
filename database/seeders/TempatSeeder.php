<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tempat;
use App\Models\FotoTempat;

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

        FotoTempat::create([
            'id_tempat' => 1,
            'nama_foto' => '/tempat/kampung-cai-ranca-upas.jpg',
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
        FotoTempat::create([
            'id_tempat' => 2,
            'nama_foto' => '/tempat/museum-baduga.jpeg',
        ]);

        Tempat::create([
            'nama_tempat' => 'Kebun Binatang Bandung',
            'alamat' => 'Jl. Tamansari No.17, Lb. Siliwangi, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132',
            'latitude' => '-6.891087049794155',
            'longitude' => '107.60726451873781',
            'deskripsi' => 'Kebun Binatang Bandung merupakan salah satu objek wisata alam flora dan fauna di Kota Bandung, Jawa Barat, Indonesia. Kebun Binatang Bandung terletak berdampingan dengan kampus Institut Teknologi Bandung dan Sungai Cikapundung.',
            'jam_buka' => '10:00',
            'jam_tutup' => '16:00',
            'hari_buka' => 'Senin',
            'hari_tutup' => 'Minggu',
            'harga_tiket' => 50000
        ]);
        FotoTempat::create([
            'id_tempat' => 3,
            'nama_foto' => '/tempat/kebun-binatang-bandung.jpeg',
        ]);

        Tempat::create([
            'nama_tempat' => 'Gedung Sate',
            'alamat' => 'Jl. Diponegoro No.22, Citarum, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40115',
            'latitude' => '-6.903186807476162',
            'longitude' => '107.61874437332155',
            'deskripsi' => 'Gedung Sate merupakan gedung kantor Gubernur Jawa Barat. Gedung ini memiliki ciri khas berupa ornamen tusuk sate pada menara sentralnya, yang telah lama menjadi penanda atau markah tanah Kota Bandung',
            'jam_buka' => '08:00',
            'jam_tutup' => '16:00',
            'hari_buka' => 'Senin',
            'hari_tutup' => 'Jumat',
            'harga_tiket' => 0
        ]);
        FotoTempat::create([
            'id_tempat' => 4,
            'nama_foto' => '/tempat/gedung-sate.jpg',
        ]);

        Tempat::create([
            'nama_tempat' => 'Stadion Siliwangi',
            'alamat' => 'Jl. Lombok No.10, Merdeka, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40113',
            'latitude' => '-6.910514679356505',
            'longitude' => '107.61952757835388',
            'deskripsi' => 'Stadion Siliwangi adalah sebuah stadion yang berada di kota Bandung, Jawa Barat. Stadion ini berada di Jl. Lombok, Bandung. Stadion ini sebelumnya bernama lapangan SPARTA. Hal ini mengacu kepada tim sepak bola militer Hindia Belanda yang ada di Bandung sekitar tahun 1916.',
            'jam_buka' => '01:00',
            'jam_tutup' => '24:00',
            'hari_buka' => 'Senin',
            'hari_tutup' => 'Minggu',
            'harga_tiket' => 0
        ]);
        FotoTempat::create([
            'id_tempat' => 5,
            'nama_foto' => '/tempat/stadion-siliwangi.jpg',
        ]);

        Tempat::create([
            'nama_tempat' => 'Taman Tegalega',
            'alamat' => '3J73+3RH, Jl. Otto Iskandar Dinata, Karanganyar, Kec. Astanaanyar, Kota Bandung, Jawa Barat 40241',
            'latitude' => '-6.935021750567224',
            'longitude' => '107.60478615760805',
            'deskripsi' => 'Taman Tegallega rekreasi ini adalah ruang terbuka yang menempati lahan luas di tengah hiruk-pikuk kota. Wisatawan tidak hanya bisa menikmati kesejukan dari pepohonan yang ada. Beragam fasilitas menarik lainnya bisa ditemukan di taman ini, seperti taman lampion dan monumen peringatan bersejarah.',
            'jam_buka' => '01:00',
            'jam_tutup' => '24:00',
            'hari_buka' => 'Senin',
            'hari_tutup' => 'Minggu',
            'harga_tiket' => 2000
        ]);
        FotoTempat::create([
            'id_tempat' => 6,
            'nama_foto' => '/tempat/taman-tegalega.jpg',
        ]);

        Tempat::create([
            'nama_tempat' => 'Museum Konferensi Asia Afrika',
            'alamat' => 'Jl. Asia Afrika No.65, Braga, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40111',
            'latitude' => '-6.921133501400531',
            'longitude' => '107.60960876941681',
            'deskripsi' => 'Musieum Konferensi Asia Afrika) merupakan salah satu museum yang berada di kota Bandung yang terletak di Jalan Asia Afrika No. 65. Museum ini merupakan memorabilia Konferensi Asia Afrika. Museum ini memiliki hubungan yang sangat erat dengan Gedung Merdeka.',
            'jam_buka' => '09:00',
            'jam_tutup' => '16:00',
            'hari_buka' => 'Senin',
            'hari_tutup' => 'Minggu',
            'harga_tiket' => 0
        ]);
        FotoTempat::create([
            'id_tempat' => 7,
            'nama_foto' => '/tempat/museum-konferensi-asia-afrika.jpg',
        ]);

        Tempat::create([
            'nama_tempat' => 'Kiara Artha Park',
            'alamat' => 'Jl. Banten, Kebonwaru, Kec. Batununggal, Kota Bandung, Jawa Barat 40272',
            'latitude' => '-6.921133501400531',
            'longitude' => '107.60960876941681',
            'deskripsi' => 'Kiara Artha Park merupakan sebuah kawasan terpadu yang memadukan konsep hunian, bisnis, komersial, dan wisata yang ikonik di Kota Bandung dengan luas + 2.9 hektar. Kiara Artha Park sendiri merupakan salah satu dari sekian banyak  ruang publik bertemakan Taman Kota yang ada di Bandung yang terletak di tengah Kota Bandung ..',
            'jam_buka' => '10:00',
            'jam_tutup' => '21:00',
            'hari_buka' => 'Senin',
            'hari_tutup' => 'Minggu',
            'harga_tiket' => 10000
        ]);
        FotoTempat::create([
            'id_tempat' => 8,
            'nama_foto' => '/tempat/kiara-artha-park.jpg',
        ]);
    }
}
