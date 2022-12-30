@extends('layouts.app')

@section('content')
<div class="relative z-10 top-full">
    <div class="flex flex-nowrap">
        @include('components.sidebar')
        <div class="absolute flex gap-10 z-50 lg:left-72 left-5 top-10">
            <!-- Content -->
            <div class="shadow-xl bg-white rounded-lg lg:w-96 w-[95%] px-10 py-5">
                <h3 class="font-bold text-xl text-center">Cari Tempat</h3><br>
                    
                <form action="" method="post">
                    @csrf
                    <div class="mb-3">
                        <input name="cari" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Map -->
    <div id="map" class="z-10" style="height:100vh;"></div>
</div>


    <!-- Custom Map -->
    <script>
        var map;
        let lat = '';
        let lng = '';

        // get lat lng
        @foreach ($tempats as $tempat) 
            lat = '{{$tempat->latitude}}'; 
            lng = '{{$tempat->longitude}}'; 
        @endforeach

        // jika tidak ditemukan
        if(lat == '' && lng == ''){
            let lat = '-6.938352857428214';
            let lng = '107.60524991427195';
            alert('Tempat tidak ada');
        }

        // init map
        map = map(lat, lng);
        
        // looping titik tempat
        let markerFoto= [];
        // looping data untuk marker
        @foreach ($tempats as $tempat)
            @foreach ($tempat->fototempat as $foto)
                markerFoto = '{{$foto->nama_foto}}';
            @endforeach

            // add marker to map
            @if(Auth::user()->role == 1)
                addMarkerAdmin('{{ $tempat->id }}', '{{ $tempat->latitude }}', '{{ $tempat->longitude }}', '{{ $tempat->nama_tempat }}', '{{ $tempat->alamat }}', markerFoto);
            @else
                addMarkerUser('{{ $tempat->id }}', '{{ $tempat->latitude }}', '{{ $tempat->longitude }}', '{{ $tempat->nama_tempat }}', '{{ $tempat->alamat }}', markerFoto);
            @endif
        @endforeach
    </script>
@endsection
