@extends('layouts.app')

@section('content')
<div class="relative z-10 top-full">
    <div class="flex flex-nowrap">
        @include('components.sidebar')
        <div class="absolute flex gap-10 z-50 right-10 top-10">
            <div class="bg-white shadow-xl rounded-lg px-10 py-7 w-72">
                <p class="font-bold text-2xl text-red-900">Jumlah Wisata</p>
                <br>
                <p class="text-right text-xs"><span class="font-bold text-xl text-blue-800">25</span> Tempat</p>
            </div>

            <div class="bg-white shadow-xl rounded-lg px-10 py-7 w-72">
                <p class="font-bold text-2xl text-red-900">Jumlah User</p>
                <br>
                <p class="text-right text-xs"><span class="font-bold text-xl text-blue-800">289</span> User</p>
            </div>

            <div class="bg-white shadow-xl rounded-lg px-10 py-7 w-72">
                <p class="font-bold text-2xl text-red-900">Jumlah Komentar</p>
                <p class="text-right text-xs"><span class="font-bold text-xl text-blue-800">825</span> Komentar</p>
            </div>
        </div>
    </div>
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
    </script>
@endsection
