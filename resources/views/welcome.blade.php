@extends('layouts.app')

@section('content')
    <div class="relative z-10 top-full">
        @include('components.navbar')
        <div class="absolute z-50 top-1/2 lg:left-[28%] left-12">
            <span class="strok text-6xl text-white font-black drop-shadow-2xl outline-4 mr-3">SELAMAT</span> 
            <span class="text-6xl text-red-600 font-black drop-shadow-2xl outline-4">DATANG</span>
        </div>
        <!-- Map -->
        <div id="map" class="z-10" style="height:100vh;"></div>
    </div>


    <!-- Custom Map -->
    <script>
        // init map
        var map;
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
            addMarker('{{ $tempat->latitude }}', '{{ $tempat->longitude }}', '{{ $tempat->nama_tempat }}', '{{ $tempat->alamat }}', markerFoto);
        @endforeach

        // coba streetview
        L.streetView({ position: 'bottomleft'}).addTo(map);
    </script>
@endsection
