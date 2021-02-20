@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<style>
    #approveApp {
        width: 400px;
        margin: auto;
        margin-top: 120px;
    }
</style>
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Appointment Requests</strong>
                    <a href="{{ url('/appointments') }}" style="align-items: center; margin-bottom: 10px; margin-left: 70px" type="button" class="btn btn-info pull-right">
                        <i class="fa fa-calendar"></i></i>&nbsp; Go back to Calendar
                      </a>
                 </div>
                <div class="card-body">
                    <table style="align-items: center" class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                            <th hidden>Applicant</th> 
                            <th>Applicant</th>
                            <th>Appointment Description</th>
                            <th>Date Requested</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointment as $item)
                                <tr style="font-size: 14px">
                                    
                                    <td hidden>{{ $item->id }}</td>
                                    <td>{{ $item->fname }} {{ $item->lname }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->created_at->format('F j, Y') }}</td>
                                    <td>
                                        
                                        <a href="" class="btn btn-success" type="button" data-appid={{$item->id}} title="approve" rel="tooltip" data-toggle="modal" data-target="#approveApp"> 
                                           <i class="fa fa-check-circle-o"></i> Approve
                                        </a>&nbsp;
                                        
                                    </td>
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- approveAppointment modal --}}
<div class="modal fade" id="approveApp" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    span aria-hidden="true">&times;</span>
                    </button>
                        <form action="{{ url('/approveAppointment') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label for="date">Appointment Date</label>
                        <input type="text" hidden name="appid" id="appid">
                        <input class="form-control" name="appointment_date" type="date" id="datefield" >
                        <div><br>
                        <button class="btn btn-success pull-right" type="submit" title="save" rel="tooltip">
                        Save
                        </button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   <script src="assets/js/main.js"></script>
<script>
    $('#approveApp').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget)  
      var appid = button.data('appid') 
      var modal = $(this)
      modal.find('.modal-body #appid').val(appid);
})
</script>

<script>
    var today = new Date();
    var dd = today.getDate()+3;
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10){
            dd='0'+dd
        } 
        if(mm<10){
            mm='0'+mm
        } 

    today = yyyy+'-'+mm+'-'+dd;
    document.getElementById("datefield").setAttribute("min", today);

  </script>
  
@endsection
