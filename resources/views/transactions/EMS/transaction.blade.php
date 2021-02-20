@extends('layouts.app')
<link rel="stylesheet" href="css/css_home.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<style>
     #mapid
  {
      height: 300px;
      width: 450px;
      margin-left: -12px;

  }


</style>
@section('content')
<div  class="container">
    <h3 style="text-align: center">EMS Transactions</h3>
    <div  class="row justify-content-center">
        <div class="col-md-10">

        </div>
        <div class="col-md-2">
            <button style="align-items: center; margin-bottom: 10px; margin-left: 70px" type="button" class="btn btn-success" data-toggle="modal" data-target="#addTran">
                <i class="fa fa-plus-square"></i></i>&nbsp; Add
            </button>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="row" style="margin-top: 10px">
                    <p class="col-sm-1" style="font-size: 17px; margin-top: 2px; margin-left: 20px">Search </p>
                    <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="col-3" id="ems_search" type="text">
                </div>
                <div style="font-weight: 700" class="card-header">Manage Enforcement and Monitoring Section (EMS) Transactions</div>
                    <table id="ems_table" class="table table-striped">
                        <thead class="thead-dark">
                            <tr style="font-size: 12px">
                            <th style="width: 110px" scope="col">Transaction ID</th>
                            <th style="width: 110px" scope="col">Procedure ID</th>
                            <th style="width: 110px" scope="col">Applicant </th>
                            <th scope="col">Address</th>
                            <th scope="col">Status</th>
                            <th scope="col">Remarks</th>
                            <th style="width: 100px; text-align:center" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction as $item)
                                <tr style="font-size: 12px">

                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->procedure_id }}</td>
                                    <td>{{ $item->lname }}, {{ $item->fname }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->status_name }}</td>
                                    <td>{{ $item->remarks }}</td>
                                    <td style="width: 100px; text-align:center">
                                       
                                        <a style="margin-bottom: 3px" href="{{ url('EMSshow_transactions/'.$item->id) }}" type="button" class="btn btn-outline-info btn-sm" title="show" rel="tooltip" >
                                            <i class="fa fa-eye"></i>
                                        </a>&nbsp;
                                        
                                        <a style="margin-bottom: 3px" href="{{ url('EMSedit_transactions/'.$item->id) }}" type="button" class="btn btn-outline-success btn-sm" title="edit" rel="tooltip" >
                                            <i class="fa fa-edit"></i>
                                        </a>&nbsp;
                                           
                                        <a href="{{ url('show_subDocs/'.$item->id) }}" type="button" class="btn btn-outline-warning btn-sm" title="submit docs" rel="tooltip" >
                                            <i class="fa fa-folder"></i>
                                        </a>&nbsp;
                                        <button class="btn btn-outline-danger btn-sm remove-tran" data-id="{{ $item->id }}" data-action="{{ url('EMSdelete_transactions/'.$item->id) }}"> <i class="fa fa-trash"></i></button>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p>&nbsp;&nbsp;Showing {{$transaction->count()}} out of {{$transaction->total() }}  results.</p>
                    {{ $transaction->links() }}
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
      $('#ems_search').keyup(function(){
        search_table($(this).val());
      });

      function search_table(value){
        $('#ems_table tr').each(function(){
          var found = 'false';
          $(this).each(function(){
            if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)
            {
              found = 'true';
            }
          });
          if(found == 'true')
          {
            $(this).show();
          }
          else
          {
            $(this).hide();
          }
        });
      }
    });
  </script>
<!--Modals-->

<!--addTran-->
<div class="modal fade" id="addTran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background: #008B8B; color: white" class="modal-header">
                Add Transaction
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form action="/EMSadd_transactions" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="procedure_id">Transaction Description</label>
                                    <select name="procedure_id" id="procedure_id" class="form-control" required>
                                        @foreach($trandesc as $item)
                                        <option value="{{ $item->id }}">{{ $item->tran_desc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="applicant_id">Applicant</label>
                                    <select name="applicant_id" id="applicant_id" class="form-control" required>
                                        @foreach($applicant as $item)
                                        <option value="{{ $item->id }}">{{ $item->lname }}, {{ $item->fname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="Address">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" class="form-control" id="longitude" placeholder="Longitude">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" name="latitude" class="form-control" id="latitude" placeholder="Latitude">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="mapid">
                                            <script>
                                                var mapCenter = [7.30806, 125.68417];
                                                var mymap = L.map('mapid').setView([7.30806, 125.68417], 18);
                                                L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=yoCDRPICkTWVZbE2KbWQ', {
                                                    attribution: 'Map data &copy; <a href="<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a></a>',
                                                    maxZoom: 20,
                                                    id: 'mapbox/streets-v11',
                                                    tileSize: 512,
                                                    zoomOffset: -1,
                                                    accessToken: 'your.mapbox.access.token'
                                                    }).addTo(mymap);

                                                    setTimeout(function(){ mymap.invalidateSize()}, 500);
                                                    var marker = L.marker(mapCenter).addTo(mymap);
                                                    var theMarker = {};

                                                    mymap.on('click',function(e){
                                                    lat = e.latlng.lat.toString().substring(0, 10);;
                                                    lon = e.latlng.lng.toString().substring(0, 10);;


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
                                <textarea type="text" name="remarks" class="form-control" id="remarks" rows="3" required></textarea>
                            </div>
                        </div>
                        </div>
                        <div style="align-items: baseline" class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--editTran-->
<div class="modal fade" id="editTran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            Edit Transaction
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

        </div>
    </div>
    </div>
</div>


<script>
    $("body").on("click",".remove-tran", function(){
      var current_object = $(this);
      swal({
          title: "Are you sure?",
          text: "You will not be able to recover this data!",
          type: "error",
          showCancelButton: true,
          dangerMode: true,
          cancelButtonClass: '#DD6B55',
          confirmButtonColor: '#dc3545',
          confirmButtonText: 'Delete!',
      },function (result) {
          if (result) {
           
              var action = current_object.attr('data-action');
              var token = jQuery('meta[name="csrf-token"]').attr('content');
              var id = current_object.attr('data-id');
             
              $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
              $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
              $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
              $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
              $('body').find('.remove-form').submit();

              
          }
      });
  });
</script>

<footer class="c-footer">
    <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
    <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
</footer>
@endsection
