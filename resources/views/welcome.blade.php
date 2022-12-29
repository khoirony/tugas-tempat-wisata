@extends('layouts.app')

@section('content')
    <div class="relative z-10 top-full">
        @include('components.navbar')
        <div class="absolute z-50 top-1/2 left-[28%]">
            <span class="strok text-6xl text-white font-black drop-shadow-2xl outline-4 mr-3">SELAMAT</span> 
            <span class="text-6xl text-red-600 font-black drop-shadow-2xl outline-4">DATANG</span>

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
