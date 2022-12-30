@extends('layouts.app')

@section('content')
<div x-data="{ card: true }" class="relative z-10 top-full">
    <div class="flex flex-nowrap lg:flex-col flex-row">
        @include('components.sidebar')

        <!-- Form Edit Tempat -->
        <div class="absolute flex gap-10 z-50 lg:left-[260px] left-5 lg:bottom-20 bottom-40 lg:h-5/6 h-2/6">
            <div x-show="card" class="bg-white rounded-lg shadow-xl py-5 px-5 lg:w-96 w-[95%] h-full">
                <div class="flex justify-between">
                    <div><a href="{{ url()->previous() }}"><i class="fa-solid fa-angles-left"></i></a></div>
                    <h3 class="text-xl font-bold text-center">Edit User</h3>
                    <div></div>
                </div>
                <br><br>
                <div class="overflow-scroll lg:h-5/6 h-4/6" id="hilanginscroll">
                    @if(Auth::user()->role == 1)
                    <form method="post" action="/edituser/{{$user->id}}" enctype="multipart/form-data">
                    @else
                    <form method="post" action="/user/editprofile" enctype="multipart/form-data">
                    @endif
                        @csrf
                        <div class="flex justify-center">
                            @if($user->profpic == null)
                            <img src="/profpic/profile.jpg" alt="foto-user" class="w-1/3 text-center rounded-full">
                            @else
                            <img src="{{ $user->profpic }}" alt="foto-user" class="w-1/3 text-center rounded-full">
                            @endif
                        </div><br>
                        <div class="mb-3">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                            <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$user->name}}" required>
                            @error('name') {{ $message }} @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$user->email}}" required>
                            @error('email') {{ $message }} @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jk" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                            <input type="text" name="jk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$user->jk}}" required>
                            @error('jk') {{ $message }} @enderror
                        </div>
                        <div class="flex mb-3">
                            <div class="mr-3">
                                <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat Lahir</label>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$user->tempat_lahir}}" required>
                                @error('tempat_lahir') {{ $message }} @enderror
                            </div>
                            <div>
                                <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$user->tanggal_lahir}}" required>
                                @error('tanggal_lahir') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                            <textarea type="text" name="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" rows="2">{{$user->alamat}}</textarea>
                            @error('alamat') {{ $message }} @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bio" class="block mb-2 text-sm font-medium text-gray-900">Bio</label>
                            <textarea type="text" name="bio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" rows="4">{{$user->bio}}</textarea>
                            @error('bio') {{ $message }} @enderror
                        </div>
                        <div class="mb-3">
                            <label for="profpic" class="block mb-2 text-sm font-medium text-gray-900">Foto Profile</label>
                            <input type="file" name="profpic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @error('profpic') {{ $message }} @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                        </div>
                    </form>
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
            @if(Auth::user()->role == 1)
            addMarkerAdmin('{{ $tempat->id }}', '{{ $tempat->latitude }}', '{{ $tempat->longitude }}', '{{ $tempat->nama_tempat }}', '{{ $tempat->alamat }}', markerFoto);
            @else
            addMarkerUser('{{ $tempat->id }}', '{{ $tempat->latitude }}', '{{ $tempat->longitude }}', '{{ $tempat->nama_tempat }}', '{{ $tempat->alamat }}', markerFoto);
            @endif
        @endforeach
    </script>
@endsection
