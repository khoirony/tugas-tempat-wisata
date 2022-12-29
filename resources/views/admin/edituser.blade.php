@extends('layouts.app')

@section('content')
<div class="relative z-10 top-full">
    @include('components.sidebar')

	<!-- Form Edit Tempat -->
    <div class="absolute bg-white rounded-lg shadow-xl py-5 px-5 z-50 left-[260px] top-9 w-96 h-5/6">
        <div class="flex justify-between">
            <div><a href="{{ url()->previous() }}"><i class="fa-solid fa-angles-left"></i></a></div>
            <h3 class="text-xl font-bold text-center">Edit User</h3>
            <div></div>
        </div>
        <br><br>
        <div class="overflow-y-auto overscroll-y-none h-5/6" id="hilanginscroll">
            @if(Auth::user()->role == 1)
            <form method="post" action="/edituser/{{$user->id}}">
            @else
            <form method="post" action="/user/editprofile">
            @endif
                @csrf
                <div class="flex justify-center">
                    <img src="/profpic/rony.jpg" alt="foto-user" class="w-1/3 text-center rounded-full">
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

        // looping titik tempat
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
