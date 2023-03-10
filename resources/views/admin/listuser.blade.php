@extends('layouts.app')

@section('content')
<div x-data="{ card: true }" class="relative z-10 top-full">
    <div class="flex flex-nowrap lg:flex-col flex-row">
        @include('components.sidebar')
        
        <!-- Angkat layer kompnen keatas map -->
        <div class="absolute flex gap-10 z-50 lg:left-[260px] left-5 lg:bottom-20 bottom-40 lg:h-5/6 h-2/6 lg:w-auto w-full">
            <div x-show="card" class="bg-white rounded-lg shadow-xl py-5 px-5 lg:w-96 w-[90%] h-full">

                <!-- Notif Success -->
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

                <!-- Title Component -->
                <div class="flex justify-between">
                    <div><button type="button" x-on:click="card = ! card"><i class="fa-solid fa-angles-left"></i></a></div>
                    <h3 class="text-xl font-bold text-center">List User</h3>
                    <div><button x-on:click="card = ! card" type="button"><i class="fa-solid fa-xmark"></i><button></div>
                </div>
                <br><br>

                <!-- overflow list user -->
                <div class="overflow-scroll lg:h-5/6 h-4/6" id="hilanginscroll">
                    @foreach($users as $user)
                    <div class="shadow-lg flex justify-between bg-red-300 pl-5 pr-2 py-2 rounded mb-5 w-full">
                        <a href="/detailuser/{{ $user->id }}" class="w-full py-1">{{ $user->name }}</a>
                        <a href="/edituser/{{ $user->id }}" class="bg-blue-600 py-1 text-white px-2 rounded mr-1"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="/hapususer/{{ $user->id }}" class="bg-red-600 py-1 text-white px-2 rounded"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                    @endforeach
                </div>
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
