@extends('layouts.app')

@section('content')
<div class="relative z-10 top-full">
    <div class="flex flex-nowrap">
        @include('components.sidebar')
        <div class="absolute flex gap-10 z-50 right-10 top-10">
            <!-- Content -->
            <div class="shadow-xl bg-white rounded-lg px-10 py-5">
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
        @php $lat ='';$lng=''; @endphp
        @foreach ($tempats as $tempat)
            @php 
                $lat = $tempat->latitude; 
                $lng = $tempat->longitude; 
            @endphp
        @endforeach
        
        @if($lat != '' && $lng != '')
        var map = L.map('map').setView([{{$lat}},{{$lng}}], 15);
        @else
            alert('Tempat tidak ada');
            var map = L.map('map').setView([-6.938352857428214,107.60524991427195], 15);
        @endif

        
            L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoia2hvaXJvbnkiLCJhIjoiY2t6c2w1anA5MHFyNjJwbzF3dHRzMmlrbSJ9.CvST75663DLudTug1RmUvg', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1Ijoia2hvaXJvbnkiLCJhIjoiY2t6c2w1anA5MHFyNjJwbzF3dHRzMmlrbSJ9.CvST75663DLudTug1RmUvg'
            }).addTo(map);

            // looping titik tempat
        @foreach ($tempats as $tempat)
            var marker{{ $tempat->id }} = new L.Marker([{{ $tempat->latitude}}, {{ $tempat->longitude }}]).addTo(map);
            @foreach ($tempat->fototempat as $foto)
                @php $pict = $foto->nama_foto @endphp;
            @endforeach
            marker{{ $tempat->id }}.bindPopup('<div class="flex justify-center"><img src="{{$pict}}" class="rounded-lg"></div> ' + '<p class="font-bold text-center my-0">{{ $tempat->nama_tempat }}</p> ' + ' {{ $tempat->alamat }} <br><br> ' + ' <div class="text-center mb-5"> <a href="/detailtempat/{{$tempat->id}}" class="bg-blue-600 px-4 py-3 rounded-lg text-center"><span class="text-white">Lihat Detail</span></a> <button type="button" class="text-white bg-red-600 px-4 py-[10px] rounded-lg" onclick="getlokasi(\'{{ $tempat->longitude }}\', \'{{ $tempat->latitude }}\');">Lihat Rute</button> </div>');
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
