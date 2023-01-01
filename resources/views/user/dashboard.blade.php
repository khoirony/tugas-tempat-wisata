@extends('layouts.app')

@section('content')
<div class="relative z-10 top-full">
    <div class="flex flex-nowrap">
        <!-- sidebar -->
        @include('components.sidebar')


        <div class="absolute flex gap-10 z-50 right-10 top-10">
            <!-- Content -->
        </div>
    </div>

    
    <!-- Map -->
    <div id="map" class="z-10" style="height:100vh;"></div>
</div>


    <!-- Custom Map -->
    <script>
        // init map
        let lat = '-6.938352857428214';
        let lng = '107.60524991427195';
        map(lat, lng);

        let markerFoto= [];
        // looping data untuk marker
        @foreach ($tempats as $tempat)
            @foreach ($tempat->fototempat as $foto)
                markerFoto = '{{$foto->nama_foto}}';
            @endforeach

            // add marker to map
            addMarkerUser('{{ $tempat->id }}', '{{ $tempat->latitude }}', '{{ $tempat->longitude }}', '{{ $tempat->nama_tempat }}', '{{ $tempat->alamat }}', markerFoto);
        @endforeach
    </script>
@endsection
