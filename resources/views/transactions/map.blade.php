@extends('layouts.app')
<style>
     #mapid
  { 
      height: 400px;
      width: 936px;
      margin-left: -12px;
      object-fit: cover;

  }

  .cover {object-fit: cover;}

</style>
@section('content')
<div style="margin-top: -20px" class="container">
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div style="font-weight: 700" class="card-header">Transactions Map</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                    <div class="cover" name="cover">
                    <div id="mapid"></div>
                        <script>
                            var mymap = L.map('mapid').setView([7.3087, 125.6841], 15);
                                L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=yoCDRPICkTWVZbE2KbWQ', {
                                attribution: 'Map data &copy; <a href="<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a></a>',
                                maxZoom: 20,
                                id: 'mapbox/streets-v11',
                                tileSize: 512,
                                zoomOffset: -1,
                                accessToken: 'your.mapbox.access.token'
                            }).addTo(mymap);

                         
                            var leafletIcon = L.icon ({
                                iconUrl: 'https://leafletjs.com/examples/custom-icons/leaf-green.png',
                                shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',
                                iconSize: [28,75],
                                iconAnchor: [22,94],
                                shadowAnchor: [4,62],
                                popupAnchor: [12, -90]
                            })
                            

                            var geoJSONdata = {
                                "type": "FeatureCollection",
                                "features": [

                                    @foreach($transactionShow as $data) 
                                    {
                                        "type": "Feature",
                                        "properties": {
                                            "tran_id": "{{ $data->id }}",
                                            "fname": "{{ $data->fname }}",
                                            "lname": "{{ $data->lname }}",
                                            "status": "{{ $data->status_name }}"
                                        },
                                        "geometry": {
                                            "type": "Point",
                                            "coordinates": [
                                                {{ $data->longitude }},
                                                {{ $data->latitude }}

                                            ]
                                        }
                                        },
                                    @endforeach
                                ]
                            };
                            
                            var myLayer = L.geoJson(geoJSONdata, {
     
                                onEachFeature: function (feature, layer) {
                                     layer.bindPopup("Track num: "+feature.properties.tran_id +"<br>"+"Applicant: <strong>"+feature.properties.lname +", "+feature.properties.fname+"</strong><br>"+"Status: <strong>"+feature.properties.status+"</strong");
                                }
                            })

                            myLayer.addTo(mymap);

                            

                    </script>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>
<div>
    
</div>
<footer class="c-footer">
    <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
    <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
</footer>
@endsection