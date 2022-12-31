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
    + ' <a href="/user/detailtempat/'+id+'"><span class="text-white bg-blue-600 px-4 py-2 rounded-lg text-center">Lihat Detail</span></a> '
    + ' <button type="button" onclick="getlokasi(\''+markerLng+'\', \''+markerLat+'\');"><span class="text-white bg-red-600 px-4 py-2 rounded-lg">Lihat Rute</span></button>'
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
    + ' <a href="/detailtempat/'+id+'"><span class="text-white bg-blue-600 px-4 py-2 rounded-lg text-center">Lihat Detail</span></a> '
    + ' <button type="button" onclick="getlokasi(\''+markerLng+'\', \''+markerLat+'\');"><span class="text-white bg-red-600 px-4 py-2 rounded-lg">Lihat Rute</span></button>'
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



// Coba Street View dari https://github.com/Zverik/leaflet-streetview
L.StreetView = L.Control.extend({
    options: {
      google: true,
    },
  
    providers: [
      ['google', 'StreetView', 'Google Street View', false,
        'https://www.google.com/maps?layer=c&cbll={lat},{lon}'],
    ],
  
    onAdd: function(map) {
      this._container = L.DomUtil.create('div', 'leaflet-bar');
      this._buttons = [];
  
      for (var i = 0; i < this.providers.length; i++)
        this._addProvider(this.providers[i]);
  
      map.on('moveend', function() {
        if (!this._fixed)
          this._update(map.getCenter());
      }, this);
      this._update(map.getCenter());
      return this._container;
    },
  
    fixCoord: function(latlon) {
      this._update(latlon);
      this._fixed = true;
    },
  
    releaseCoord: function() {
      this._fixed = false;
      this._update(this._map.getCenter());
    },
  
    _addProvider: function(provider) {
      if (!this.options[provider[0]])
        return;
      if (provider[0] == 'mapillary' && !this.options.mapillaryId)
        return;
      var button = L.DomUtil.create('a');
      button.innerHTML = provider[1];
      button.title = provider[2];
      button._bounds = provider[3];
      button._template = provider[4];
      button.href = '#';
      button.target = 'streetview';
      button.style.padding = '0 8px';
      button.style.width = 'auto';
  
      // Some buttons require complex logic
      if (provider[0] == 'mapillary') {
        button._needUrl = false;
        L.DomEvent.on(button, 'click', function(e) {
          if (button._href) {
            this._ajaxRequest(
              button._href.replace(/{id}/, this.options.mapillaryId),
              function(data) {
                if (data && data.features && data.features[0].properties) {
                  var photoKey = data.features[0].properties.key,
                      url = 'https://www.mapillary.com/map/im/{key}'.replace(/{key}/, photoKey);
                  window.open(url, button.target);
                }
              }
            );
          }
          return L.DomEvent.preventDefault(e);
        }, this);
      } else if (provider[0] == 'openstreetcam') {
        button._needUrl = false;
        L.DomEvent.on(button, 'click', function(e) {
          if (button._href) {
            this._ajaxRequest(
              'http://openstreetcam.org/nearby-tracks',
              function(data) {
                if (data && data.osv && data.osv.sequences) {
                  var seq = data.osv.sequences[0],
                      url = 'https://www.openstreetcam.org/details/'+seq.sequence_id+'/'+seq.sequence_index;
                  window.open(url, button.target);
                }
              },
              button._href
            );
          }
          return L.DomEvent.preventDefault(e);
        }, this);
      } else
        button._needUrl = true;
  
      // Overriding some of the leaflet styles
      button.style.display = 'inline-block';
      button.style.border = 'none';
      button.style.borderRadius = '0 0 0 0';
      this._buttons.push(button);
    },
  
    _update: function(center) {
      if (!center)
        return;
      var last;
      for (var i = 0; i < this._buttons.length; i++) {
        var b = this._buttons[i],
            show = !b._bounds || b._bounds.contains(center),
            vis = this._container.contains(b);
  
        if (show && !vis) {
          ref = last ? last.nextSibling : this._container.firstChild;
          this._container.insertBefore(b, ref);
        } else if (!show && vis) {
          this._container.removeChild(b);
          return;
        }
        last = b;
  
        var tmpl = b._template;
        tmpl = tmpl
          .replace(/{lon}/g, L.Util.formatNum(center.lng, 6))
          .replace(/{lat}/g, L.Util.formatNum(center.lat, 6));
        if (b._needUrl)
          b.href = tmpl;
        else
          b._href = tmpl;
      }
    },
  
    _ajaxRequest: function(url, callback, post_data) {
      if (window.XMLHttpRequest === undefined)
        return;
      var req = new XMLHttpRequest();
      req.open(post_data ? 'POST' : "GET", url);
      if (post_data)
        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      req.onreadystatechange = function() {
        if (req.readyState === 4 && req.status == 200) {
          var data = (JSON.parse(req.responseText));
          callback(data);
        }
      };
      req.send(post_data);
    }
  });
  
  L.streetView = function(options) {
    return new L.StreetView(options);
  }