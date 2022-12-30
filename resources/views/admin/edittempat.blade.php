@extends('layouts.app')

@section('content')
<div class="relative z-10 top-full">
    @include('components.sidebar')

	<!-- Form Edit Tempat -->
    <div class="absolute bg-white rounded-lg shadow-xl py-5 px-5 z-50 left-[260px] top-9 w-96 h-5/6">
        <div class="flex justify-between">
            <div><a href="{{ url()->previous() }}"><i class="fa-solid fa-angles-left"></i></a></div>
            <h3 class="text-xl font-bold text-center">Edit Tempat Wisata</h3>
            <div></div>
        </div>
        <br><br>
        <div class="overflow-y-auto overscroll-y-none h-5/6" id="hilanginscroll">
            <form method="post" action="/edittempat/{{$tempat->id}}" enctype="multipart/form-data">
                @csrf
                <div class="flex mb-3">
                    <div class="mr-3">
                        <label for="latitude" class="block mb-2 text-sm font-medium text-gray-900">Latitude</label>
                        <input type="text" id="latitude" name="latitude" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$tempat->latitude}}" required>
                        @error('latitude') {{ $message }} @enderror
                    </div>
                    <div>
                        <label for="longitude" class="block mb-2 text-sm font-medium text-gray-900">Longitude</label>
                        <input type="text" id="longitude" name="longitude" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$tempat->longitude}}" required>
                        @error('longitude') {{ $message }} @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Nama Tempat</label>
                    <input type="text" name="nama_tempat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$tempat->nama_tempat}}" required>
                    @error('nama_tempat') {{ $message }} @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                    <textarea type="text" name="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" rows="2">{{$tempat->alamat}}</textarea>
                    @error('alamat') {{ $message }} @enderror
                </div>
                <div class="flex mb-3">
                    <div class="mr-3">
                        <label for="hari_buka" class="block mb-2 text-sm font-medium text-gray-900">Hari Buka</label>
                        <input type="text" id="hari_buka" name="hari_buka" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$tempat->hari_buka}}" required>
                        @error('hari_buka') {{ $message }} @enderror
                    </div>
                    <div>
                        <label for="hari_tutup" class="block mb-2 text-sm font-medium text-gray-900">Hari Tutup</label>
                        <input type="text" id="hari_tutup" name="hari_tutup" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$tempat->hari_tutup}}" required>
                        @error('hari_tutup') {{ $message }} @enderror
                    </div>
                </div>
                <div class="flex mb-3">
                    <div class="mr-3 w-1/2">
                        <label for="jam_buka" class="block mb-2 text-sm font-medium text-gray-900">Jam Buka</label>
                        <input type="time" id="jam_buka" name="jam_buka" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$tempat->jam_buka}}" required>
                        @error('jam_buka') {{ $message }} @enderror
                    </div>
                    <div class="w-1/2">
                        <label for="jam_tutup" class="block mb-2 text-sm font-medium text-gray-900">Jam Tutup</label>
                        <input type="time" id="jam_tutup" name="jam_tutup" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$tempat->jam_tutup}}" required>
                        @error('jam_tutup') {{ $message }} @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="harga_tiket" class="block mb-2 text-sm font-medium text-gray-900">Harga Tiket</label>
                    <input type="number" name="harga_tiket" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$tempat->harga_tiket}}" required>
                    @error('harga_tiket') {{ $message }} @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Tempat</label>
                    <textarea type="text" name="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" rows="4">{{$tempat->deskripsi}}</textarea>
                    @error('deskripsi') {{ $message }} @enderror
                </div>
                <div class="mb-3">
                    <label for="foto_tempat" class="block mb-2 text-sm font-medium text-gray-900">Foto Tempat</label>
                    <input type="file" name="foto_tempat[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" multiple>
                    @error('foto_tempat') {{ $message }} @enderror
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
        var map;
        // init map
        let lat = '-6.938352857428214';
        let lng = '107.60524991427195';
        map = map(lat, lng);

        let markerFoto= [];
        // looping data untuk marker
        @foreach ($tempats as $tempat)
            @foreach ($tempat->fototempat as $foto)
                markerFoto = '{{$foto->nama_foto}}';
            @endforeach

            // add marker to map
            addMarkerAdmin('{{ $tempat->id }}', '{{ $tempat->latitude }}', '{{ $tempat->longitude }}', '{{ $tempat->nama_tempat }}', '{{ $tempat->alamat }}', markerFoto);
        @endforeach
    </script>
@endsection
