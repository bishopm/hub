<x-hub::layouts.churches pageName="{{$church->church}}">
    <h3>{{$church->church}}</h3>
    <div class="row">
        <div class="col-md">
            Details here
        </div>
        <div class="col-md">
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
                var marker = L.marker([{{$church->latitude}}, {{$church->longitude}}]).bindPopup('{{$church->church}}').addTo(map);
                var markers = [[{{$church->latitude}}, {{$church->longitude}}]];
                var bounds = new L.LatLngBounds(markers);
                map.fitBounds(bounds, {padding: [25,25]});
            </script>
        </div>
    </div>
</x-hub::layouts.churches>