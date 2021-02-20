@extends('layouts.app')
<link rel="stylesheet" href="css/css_home.css">
<style>
     #mapid
  { 
      height: 300px;
      width: 900px;
      margin-left: -12px;

  }
</style>
@section('content')
<div class="container">
    <div class="col-md-14">
        <div class="card">
        <div class="card-header">Edit Transaction Number: {{$transaction->id}}</div>
            <div class="card-body">
                
                <form action="{{ url('EMSupdate_transactions/'.$transaction->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="permit_ID">Procedure ID</label>
                                <select name="procedure_id" id="procedure_id" class="form-control" required>
                                  @foreach($trandesc as $item)
                                    <option value="{{ $item->id }}" {{($item->id==$transaction->procedure_id) ? 'selected' : ''}}>{{ $item->tran_desc }}</option>
                                  @endforeach
                                </select>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="applicant_id">Applicant ID(not editable)</label>
                                <input type="text" name="applicant_id" class="form-control" id="applicant_id" placeholder="" value="{{ $transaction->applicant_id }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address" placeholder="" value="{{ $transaction->address }}" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                            <input type="text" name="latitude" class="form-control" id="latitude" placeholder="Latitude" value="{{ $transaction->latitude}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" name="longitude" class="form-control" id="longitude" placeholder="Longitude" value="{{ $transaction->longitude}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="mapid">
                                        <script>
                                            var mapCenter = [{{ $transaction->latitude }}, {{ $transaction->longitude }}];
                                              var mymap = L.map('mapid').setView([{{ $transaction->latitude }}, {{ $transaction->longitude }}], 15);
                                              L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=yoCDRPICkTWVZbE2KbWQ', {
                                                attribution: 'Map data &copy; <a href="<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a></a>',
                                                maxZoom: 20,
                                                id: 'mapbox/streets-v11',
                                                tileSize: 512,
                                                zoomOffset: -1,
                                                accessToken: 'your.mapbox.access.token'
                                                }).addTo(mymap);
                                                var marker = L.marker(mapCenter).addTo(mymap);
                                                var theMarker = {};
                        
                                                mymap.on('click',function(e){
                                                    lat = e.latlng.lat.toString().substring(0, 15);;
                                                    lon = e.latlng.lng.toString().substring(0, 15);;
                                                
                            
                                                //Clear existing marker, 
                                        
                                                if (theMarker != undefined) {
                                                    mymap.removeLayer(theMarker);
                                                };
                                                mymap.removeLayer(marker);
                                                $('#latitude').val(lat);
                                                $('#longitude').val(lon);
                        
                                                    //Add a marker to show where you clicked.
                                                    theMarker = L.marker([lat,lon]).addTo(mymap);  
                                                });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                        <textarea type="text" name="remarks" class="form-control" id="remarks" rows="3" required>{{ $transaction->remarks }}</textarea>
                        </div>
                    </div>
                    </div>
                    <div style="align-items: baseline" class="modal-footer">
                        <button type="submit" class="btn btn-round btn-primary btn-success pull-right">Update</button>
                        <a href="{{ url('transactions/EMS/transaction') }}" type="button" class="btn btn-round btn-secondary pull-right">Back</a>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="c-footer">
    <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
    <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
</footer>
@endsection