@extends('layouts.app')

@section('content')
<div class="relative z-10 top-full">
    <div class="flex flex-nowrap">
        @include('components.sidebar')
        
        <div class="absolute flex lg:flex-row flex-col gap-5 z-50 lg:left-[260px] left-5 top-10 lg:w-[55%] w-[90%]">
            <div class="bg-white shadow-xl rounded-lg px-5 py-7 lg:w-72 w-full">
                <p class="font-extrabold text-2xl text-red-900">Jumlah Wisata</p>
                <br>
                <p class="text-right text-sm font-medium"><span class="font-bold text-3xl text-blue-800">{{ $jmltempat }} </span> Tempat</p>
            </div>

            <div class="bg-white shadow-xl rounded-lg px-5 py-7 lg:w-72 w-full">
                <p class="font-extrabold text-2xl text-red-900">Jumlah User</p>
                <br>
                <p class="text-right text-sm font-medium"><span class="font-bold text-3xl text-blue-800">{{ $jmluser }} </span> User</p>
            </div>

            <div class="bg-white shadow-xl rounded-lg px-5 py-7 lg:w-72 w-full">
                <p class="font-extrabold text-2xl text-red-900">Jml Komentar</p>
                <br>
                <p class="text-right text-sm font-medium"><span class="font-bold text-3xl text-blue-800">{{ $jmlkomentar }} </span> Komentar</p>
            </div>
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
