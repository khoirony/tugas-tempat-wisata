@extends('layouts.base')

@section('body')

    <div class="relative z-10 top-full">
        @include('components.navbar')
        <div class="absolute z-50 left-[35%] flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            @if(session()->has('success'))
                <div id="alert-4" class="flex p-4 mb-2 mt-7 bg-yellow-100 rounded-lg" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-yellow-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium text-yellow-700">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session()->has('loginError'))
            <div id="alert-2" class="flex p-4 mb-2 mt-7 bg-red-400 rounded-lg" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium text-white">
                    {{ session('loginError') }}
                </div>
            </div>
            @endif

            <div class="w-full bg-white rounded-lg shadow-lg md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Sign in to your account
                    </h1>
                    <form action="" method="POST" class="row g-3 needs-validation">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Address</label>
                            <input type="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 @error('email') is-invalid @enderror" name="email"
                            id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">

                            @error('email')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div>
                            <label for="yourPassword" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" name="password" id="password" placeholder="Password"
                                required>
                        </div>

                        <div class="mt-7">
                            <button class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Login</button>
                        </div>

                        <div>
                            <p class="mt-1 text-sm font-light text-gray-500">Don't have account? <a href="/register" class="font-medium text-blue-600 hover:underline">Create an account</a></p>
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
