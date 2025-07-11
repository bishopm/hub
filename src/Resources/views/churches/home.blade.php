<x-hub::layouts.churches pageName="Home">
  <div style="height:400px" id="map"></div>
    <script>
        var map = L.map('map');
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiYmlzaG9wbSIsImEiOiJjanNjenJ3MHMwcWRyM3lsbmdoaDU3ejI5In0.M1x6KVBqYxC2ro36_Ipz_w'
        }).addTo(map);
        var churchIcon = L.icon({
          iconUrl: '/hub/css/images/churchlocation.png',
          iconSize:     [28, 35], // size of the icon
          // iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
          // shadowAnchor: [4, 62],  // the same for the shadow
          // popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
        @foreach ($churches as $church)
            var marker = L.marker([{{$church->latitude}}, {{$church->longitude}}], {icon: churchIcon}).bindPopup('<a href="{{url()->current() . '/churches/' . $church->slug}}">{{$church->church}}</a>').addTo(map);
        @endforeach
        var markers = [
        @foreach ($churches as $church)
             [{{$church->latitude}}, {{$church->longitude}}],
        @endforeach
        ];
        var bounds = new L.LatLngBounds(markers);
        map.fitBounds(bounds, {padding: [25,25]});
    </script>
</x-hub::layouts.churches>