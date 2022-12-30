@extends('layouts.app')

@section('content')
<div class="relative z-10 top-full">
    @include('components.sidebar')

	<!-- Form Tambah Tempat -->
    <div class="absolute bg-white rounded-lg shadow-xl py-5 px-5 z-50 left-[260px] top-9 w-96 h-5/6">
        @if(session()->has('success'))
            <div id="alert-4" class="flex p-4 mb-4 bg-yellow-100 rounded-lg" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-yellow-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium text-yellow-700">
                {{ session('success') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-yellow-100 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex h-8 w-8" data-dismiss-target="#alert-4" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            </div>
        @endif
        <div class="flex justify-between">
            <div><a href="{{ url()->previous() }}"><i class="fa-solid fa-angles-left"></i></a></div>
            <h3 class="text-xl font-bold text-center">{{ $tempat->nama_tempat }}</h3>
            <div></div>
        </div>
        <br><br>
        @if(session()->has('success'))
        <div class="overflow-scroll h-[70%]" id="hilanginscroll">
        @else
        <div class="overflow-scroll h-5/6" id="hilanginscroll">
        @endif
            <div class="text-justify h-full">
                
                <!-- Slider main container -->
                <div class="swiper h-[200px]">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach($tempat->fototempat as $foto)
                        <div class="swiper-slide">
                            <img src="{{$foto->nama_foto}}" alt="{{ $tempat->nama_tempat }}" class="object-cover w-full">
                        </div>
                        @endforeach
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                
                <br><br>
                {{ $tempat->deskripsi }} <br><br>
                <p><span class="font-bold">Alamat:</span> {{ $tempat->alamat }}</p>
                <p><span class="font-bold">Jam Buka:</span> {{ $tempat->jam_buka }} - {{ $tempat->jam_tutup }}</p> 
                <p><span class="font-bold">Hari Buka:</span> {{ $tempat->hari_buka }} - {{ $tempat->hari_tutup }}</p>
                <p><span class="font-bold">Harga Tiket:</span> Rp {{ $tempat->harga_tiket }},-</p>
                <div class="flex justify-center gap-5 mt-5">
                    @if(Auth::user()->role == 1)
                    <a href="/edittempat/{{ $tempat->id }}" class="shadow w-[30%] bg-blue-600 text-white text-center rounded py-1 px-5 font-medium">Edit</a>
                    <a href="/hapustempat/{{ $tempat->id }}" class="shadow w-[30%] bg-red-600 text-white text-center rounded py-1 px-5 font-medium">Hapus</a>
                    @else
                        <button type="button" class="text-white shadow-lg bg-red-600 px-4 py-1 rounded font-medium" onclick="getlokasi('{{ $tempat->longitude }}', '{{ $tempat->latitude }}');">
                            Cari Rute
                        </button>
                    @endif
                    @livewire('form.komentar', ['id_tempat' => $tempat->id ])
                </div>
            </div>
        </div>
    </div>

    <!-- Map -->
    <div id="map" class="z-10" style="height:100vh;"></div>
</div>

    <script>
        const swiper = new Swiper('.swiper', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar',
        },
        });
    </script>

    <!-- Custom Map -->
    <script>
        var map;
        // init map
        let lat = '{{$tempat->latitude}}';
        let lng = '{{$tempat->longitude}}';
        map = map(lat, lng);

        let markerFoto= [];
        @foreach ($tempat->fototempat as $foto)
            markerFoto = '{{$foto->nama_foto}}';
        @endforeach
        addMarkerAdmin('{{ $tempat->id }}', '{{ $tempat->latitude }}', '{{ $tempat->longitude }}', '{{ $tempat->nama_tempat }}', '{{ $tempat->alamat }}', markerFoto);
    </script>
@endsection
