@extends('layouts.app')

@section('content')
<div class="relative z-10 top-full">
    @include('components.sidebar')

    <!-- Map -->
    <div id="map" class="z-10" style="height:100vh;"></div>
</div>


    <!-- Custom Map -->
    <script>
        var map = L.map('map').setView([-6.938352857428214,107.60524991427195], 15);
        
            L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoia2hvaXJvbnkiLCJhIjoiY2t6c2w1anA5MHFyNjJwbzF3dHRzMmlrbSJ9.CvST75663DLudTug1RmUvg', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1Ijoia2hvaXJvbnkiLCJhIjoiY2t6c2w1anA5MHFyNjJwbzF3dHRzMmlrbSJ9.CvST75663DLudTug1RmUvg'
            }).addTo(map);

        function getlokasi() {
            //jika browser mendukung navigator.geolocation maka akan menjalankan perintah di bawahnya
            if (navigator.geolocation) {
                // getCurrentPosition digunakan untuk mendapatkan lokasi pengguna
                //showPosition adalah fungsi yang akan dijalankan
                navigator.geolocation.getCurrentPosition(showPositionKlik);
            }
        }

        function showPositionKlik(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
        
            L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoia2hvaXJvbnkiLCJhIjoiY2t6c2w1anA5MHFyNjJwbzF3dHRzMmlrbSJ9.CvST75663DLudTug1RmUvg', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1Ijoia2hvaXJvbnkiLCJhIjoiY2t6c2w1anA5MHFyNjJwbzF3dHRzMmlrbSJ9.CvST75663DLudTug1RmUvg'
            }).addTo(map);
            
            L.Routing.control({
            waypoints: [
                L.latLng(latitude, longitude),
                L.latLng(-6.938352857428214,107.60524991427195)
            ]
            }).addTo(map);
            
            var popup = L.popup()
            .setLatLng([latitude, longitude])
            .setContent("My Location")
            .openOn(map);
        }

    </script>
@endsection
