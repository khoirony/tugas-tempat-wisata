@extends('layouts.app')

@section('content')
<div class="relative z-10 top-full">
    @include('components.sidebar')

	<!-- Form Tambah Tempat -->
    <div class="absolute bg-white rounded-lg shadow-xl py-5 px-5 z-50 left-[260px] bottom-20 w-96 h-5/6">
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
        <h3 class="text-xl font-bold text-center">List Tempat Wisata</h3>
        <br><br>
        <div class="overflow-auto">
            @foreach($tempats as $tempat)
            <div class="shadow-lg flex justify-between bg-red-300 pl-5 pr-2 py-2 rounded mb-5 w-full">
                <a href="/detailtempat/{{ $tempat->id }}" class="w-full py-1">{{ $tempat->nama_tempat }}</a>
                <button type="button" class="text-black bg-white px-4 py-1 rounded" onclick="getlokasi('{{ $tempat->longitude }}', '{{ $tempat->latitude }}');">
                    Rute
                </button>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Map -->
    <div id="map" class="z-10" style="height:100vh;"></div>
</div>


    <!-- Custom Map -->
    <script>
        var map = L.map('map').setView([-6.938352857428214, 107.60524991427195], 12);

        // render map
		L.tileLayer(
			'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoia2hvaXJvbnkiLCJhIjoiY2t6c2w1anA5MHFyNjJwbzF3dHRzMmlrbSJ9.CvST75663DLudTug1RmUvg', {
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

        let lng;
        let lat;
        function getlokasi(lng,lat) {
            // parsing kordinat ke global
            this.lng = lng;
            this.lat = lat;

            // check browser support
            if (navigator.geolocation) {
                // get position
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        let rute = null;
        function showPosition(position) {

            // check rute sudah ada apa tidak
            if(rute != null){
                // jika rute ada, hapus rute
                rute.setWaypoints();
                rute ._container.style.display = "none";
            }
                
            // menampilkan route
            rute = L.Routing.control({
            waypoints: [
                // koordinat awal
                L.latLng(position.coords.latitude, position.coords.longitude),
                // koordinat tujuan (get data from global variable)
                L.latLng(this.lat,this.lng)
            ]
            }).addTo(map);

            // Popup lokasi saya
            var popup = L.popup()
            .setLatLng([position.coords.latitude, position.coords.longitude])
            .setContent("Lokasiku")
            .openOn(map);
        }
    </script>
@endsection
