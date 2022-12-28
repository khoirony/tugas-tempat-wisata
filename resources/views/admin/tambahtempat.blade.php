@extends('layouts.app')

@section('content')
<div class="relative z-10 top-full">
    @include('components.sidebar')

	<!-- Form Tambah Tempat -->
    <div class="absolute bg-white rounded-lg shadow-xl py-5 px-5 z-50 left-[260px] bottom-20 w-96 h-5/6">
        <h3 class="text-xl font-bold text-center">Tambah Tempat Wisata</h3>
        <br><br>
        <div class="overflow-y-auto overscroll-y-none h-5/6" id="hilanginscroll">
            <form method="post" action="/tambahtempat">
                @csrf
                <div class="flex mb-3">
                    <div class="mr-3">
                        <label for="latitude" class="block mb-2 text-sm font-medium text-gray-900">Latitude</label>
                        <input type="text" id="latitude" name="latitude" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        @error('latitude') {{ $message }} @enderror
                    </div>
                    <div>
                        <label for="longitude" class="block mb-2 text-sm font-medium text-gray-900">Longitude</label>
                        <input type="text" id="longitude" name="longitude" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        @error('longitude') {{ $message }} @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Nama Tempat</label>
                    <input type="text" name="nama_tempat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    @error('nama_tempat') {{ $message }} @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                    <textarea type="text" name="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" rows="2"></textarea>
                    @error('alamat') {{ $message }} @enderror
                </div>
                <div class="flex mb-3">
                    <div class="mr-3">
                        <label for="hari_buka" class="block mb-2 text-sm font-medium text-gray-900">Hari Buka</label>
                        <input type="text" id="hari_buka" name="hari_buka" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        @error('hari_buka') {{ $message }} @enderror
                    </div>
                    <div>
                        <label for="hari_tutup" class="block mb-2 text-sm font-medium text-gray-900">Hari Tutup</label>
                        <input type="text" id="hari_tutup" name="hari_tutup" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        @error('hari_tutup') {{ $message }} @enderror
                    </div>
                </div>
                <div class="flex mb-3">
                    <div class="mr-3 w-1/2">
                        <label for="jam_buka" class="block mb-2 text-sm font-medium text-gray-900">Jam Buka</label>
                        <input type="time" id="jam_buka" name="jam_buka" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        @error('jam_buka') {{ $message }} @enderror
                    </div>
                    <div class="w-1/2">
                        <label for="jam_tutup" class="block mb-2 text-sm font-medium text-gray-900">Jam Tutup</label>
                        <input type="time" id="jam_tutup" name="jam_tutup" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        @error('jam_tutup') {{ $message }} @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="harga_tiket" class="block mb-2 text-sm font-medium text-gray-900">Harga Tiket</label>
                    <input type="number" name="harga_tiket" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    @error('harga_tiket') {{ $message }} @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Tempat</label>
                    <textarea type="text" name="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" rows="4"></textarea>
                    @error('deskripsi') {{ $message }} @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Map -->
    <div id="map" class="z-10" style="height:100vh;"></div>
</div>


    <!-- Custom Map -->
    <script>
        var map = L.map('map').setView([-6.938352857428214, 107.60524991427195], 12);

		L.tileLayer(
			'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoia2hvaXJvbnkiLCJhIjoiY2t6c2w1anA5MHFyNjJwbzF3dHRzMmlrbSJ9.CvST75663DLudTug1RmUvg', {
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				maxZoom: 25,
				id: 'mapbox/streets-v11',
				tileSize: 512,
				zoomOffset: -1,
				accessToken: 'pk.eyJ1Ijoia2hvaXJvbnkiLCJhIjoiY2t6c2w1anA5MHFyNjJwbzF3dHRzMmlrbSJ9.CvST75663DLudTug1RmUvg'
			}
		).addTo(map);

        @foreach ($tempats as $tempat)
            var marker{{ $tempat->id }} = new L.Marker([{{ $tempat->latitude}}, {{ $tempat->longitude }}]).addTo(map);
            
            marker{{ $tempat->id }}.bindPopup('Nama: {{ $tempat->nama_tempat }} <br> Alamat: {{ $tempat->alamat }}');
        @endforeach

        map.on('click', function(e) {
            var marker = new L.Marker([e.latlng.lat,e.latlng.lng]);
            marker.addTo(map);
            document.getElementById("latitude").value = e.latlng.lat;
            document.getElementById("longitude").value = e.latlng.lng;
        });
    </script>
@endsection
