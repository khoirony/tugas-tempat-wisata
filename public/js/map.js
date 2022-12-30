var map;

function map(lat,lng){
    initiateMap(lat, lng);
    return this.map;
}

function initiateMap(lat, lng){
    // render map
    this.map = L.map('map').setView([lat, lng], 12);
    
    L.tileLayer(
        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoia2hvaXJvbnkiLCJhIjoiY2t6c2w1anA5MHFyNjJwbzF3dHRzMmlrbSJ9.CvST75663DLudTug1RmUvg', {
            maxZoom: 25,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1Ijoia2hvaXJvbnkiLCJhIjoiY2t6c2w1anA5MHFyNjJwbzF3dHRzMmlrbSJ9.CvST75663DLudTug1RmUvg'
        }
    ).addTo(this.map);
}

function addMarker(markerLat, markerLng, markerNama, markerAlamat, markerFoto){
    var marker;
    marker = new L.Marker([markerLat, markerLng]).addTo(this.map);

    // tambah cuplikan detail di marker
    marker.bindPopup('<div class="flex justify-center">'
    +'<img src="'+markerFoto+'" class="rounded-lg">'
    +'</div> ' 
    + '<p class="font-bold text-center my-0">'+markerNama+'</p> ' 
    + markerAlamat +' <br><br>');

    return marker;
}

function addMarkerUser(id, markerLat, markerLng, markerNama, markerAlamat, markerFoto){
    var marker;
    marker = new L.Marker([markerLat, markerLng]).addTo(this.map);

    // tambah cuplikan detail di marker
    marker.bindPopup('<div class="flex justify-center">'
    +'<img src="'+markerFoto+'" class="rounded-lg">'
    +'</div> ' 
    + '<p class="font-bold text-center my-0">'+markerNama+'</p> ' 
    + markerAlamat +' <br><br>'
    + ' <div class="text-center mb-5"> '
    + ' <a href="/user/detailtempat/'+id+'" class="bg-blue-600 px-4 py-3 rounded-lg text-center">@endif<span class="text-white">Lihat Detail</span></a> '
    + ' <button type="button" class="text-white bg-red-600 px-4 py-[10px] rounded-lg" onclick="getlokasi(\''+markerLng+'\', \''+markerLat+'\');">Lihat Rute</button>'
    + ' </div>');

    return marker;
}

function addMarkerAdmin(id, markerLat, markerLng, markerNama, markerAlamat, markerFoto){
    var marker;
    marker = new L.Marker([markerLat, markerLng]).addTo(this.map);

    // tambah cuplikan detail di marker
    marker.bindPopup('<div class="flex justify-center">'
    +'<img src="'+markerFoto+'" class="rounded-lg">'
    +'</div> ' 
    + '<p class="font-bold text-center my-0">'+markerNama+'</p> ' 
    + markerAlamat +' <br><br>'
    + ' <div class="text-center mb-5"> '
    + ' <a href="/detailtempat/'+id+'" class="bg-blue-600 px-4 py-2 rounded-lg text-center"><span class="text-white">Lihat Detail</span></a> '
    + ' <button type="button" class="text-white bg-red-600 px-4 py-3 rounded-lg" onclick="getlokasi(\''+markerLng+'\', \''+markerLat+'\');">Lihat Rute</button>'
    + ' </div>');

    return marker;
}

let myLng;
let myLat;
function getlokasi(lng,lat) {
    // parsing kordinat ke global
    this.myLng = lng;
    this.myLat = lat;

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
        L.latLng(this.myLat,this.myLng)
    ]
    }).addTo(map);

    // Popup lokasi saya
    var popup = L.popup()
    .setLatLng([position.coords.latitude, position.coords.longitude])
    .setContent("Lokasiku")
    .openOn(map);
}