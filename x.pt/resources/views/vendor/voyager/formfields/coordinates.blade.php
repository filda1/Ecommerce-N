<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
<style>
    #map {
        height: 400px;
        width: 100%;
    }
    input{
        padding: 4px 15px 4px 12px!important;
        color: #76838f;
        background-color: #fff;
        background-image: none;
        border: 1px solid #e4eaec;
    }

    #resultado{
        position: absolute;
        background: white;
        width: 293px;
        padding: 0;
        list-style: none;
        box-shadow: #afafaf 0px 0px 5px;
        width: 97%;
        top: 60px;
        z-index: 9999;
    }

    #resultado>li{
        margin-bottom: 10px;
        cursor: pointer;
    }

    #resultado>li>div{
        padding: 5px;
    }

    #resultado>li:hover{
        background: #5897fb;
        color: white;
    }
</style>

@forelse($dataTypeContent->getCoordinates() as $point)
    <input type="hidden" name="{{ $row->field }}[lat]" value="{{ $point['lat'] }}" id="lat"/>
    <input type="hidden" name="{{ $row->field }}[lng]" value="{{ $point['lng'] }}" id="lng"/>
@empty
    <input type="hidden" name="{{ $row->field }}[lat]" value="{{ $dataTypeContent->lat }}" id="lat"/>
    <input type="hidden" name="{{ $row->field }}[lng]" value="{{ $dataTypeContent->lng }}" id="lng"/>
@endforelse

</br>
<input class="col-md-12" type="text" id="pesquisa" onkeyup="search()" placeholder="Pesquisa" autocomplete="off"/>
<ul id="resultado"></ul>
</br></br>
<div id="map"></div>

<script>
var results;

var a;

if ("{{$dataTypeContent->lat}}" != "" || "{{$dataTypeContent->lng}}" != "") {
    mapas("{{ $dataTypeContent->lat }}", "{{ $dataTypeContent->lng }}");
}else{
    getmapas();
}

    function search(){
        $.ajax({url: "https://nominatim.openstreetmap.org/search/?q="+ $('#pesquisa').val() +"&format=json", success: function(result){
            results = result;
            $('#resultado').empty();
            for (var i = 0; i < result.length; i++) {
                $('#resultado').append('<li onclick="selectedLocalidade('+ result[i]["lat"] + ',' + result[i]["lon"] +')"><div>' + result[i]["display_name"] + "</div></li>");
            }
        }});
    }

    function selectedLocalidade(lat, long){
        
        $('#lat').val(lat);
        $('#lng').val(long);
        $('#resultado').empty();
        a = lat;
        b = long;
        mapas(a, b);
        return true;
    }
    var map;
    //Map
    function mapas(a, b){
        var options = {
            
            center: [a, b],

            zoom: 17
        }

        if (map && map.remove) {
          map.off();
          map.remove();
        }

        map = L.map('map', options);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'OSM'})
        .addTo(map);

        L.circle([a, b], {{setting('app.distancia_raio_estabelecimento') * 1000}}).addTo(map);

        var myMarker = L.marker([a, b], {title: "Meu Ponto", alt: "Original", draggable: true})
        .addTo(map)
        .on('dragend', function() {
            var coord = String(myMarker.getLatLng()).split(',');
            var lat = coord[0].split('(');
            var lng = coord[1].split(')');
            myMarker.bindPopup("Moved to: " + lat[1] + ", " + lng[0] + ".");
            document.getElementById("lat").value = lat[1];
            document.getElementById("lng").value = lng[0];
        });
    }
    //Map

    //Map
    function getmapas(){
        var options = {
            
            center: [41.277, -8.28274],

            zoom: 17
        }

        map = L.map('map', options);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'OSM'})
        .addTo(map);

        var myMarker = L.marker([41.277, -8.28274], {title: "Meu Ponto", alt: "Original", draggable: true})
        .addTo(map)
        .on('dragend', function() {
            var coord = String(myMarker.getLatLng()).split(',');
            var lat = coord[0].split('(');
            var lng = coord[1].split(')');
            myMarker.bindPopup("Moved to: " + lat[1] + ", " + lng[0] + ".");
            document.getElementById("lat").value = lat[1];
            document.getElementById("lng").value = lng[0];
        });
    }
    //Map

</script>