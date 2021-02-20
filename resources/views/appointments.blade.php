@extends('layouts.app')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script>
    $('.date').datepicker({
        autoclose: true,
        dateFormat: "dd-mm-yy"
    });
</script>
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
                <div style="font-weight: 700" class="card-header">Appointment Calendar</div>
                <div class="card-body">
                    <a href="{{ url('/showPendingAppointments') }}" style="align-items: center; margin-bottom: 10px; margin-left: 70px" type="button" class="btn btn-info pull-right">
                      <i class="fa fa-calendar"></i></i>&nbsp; Show Pending Requests
                    </a>
                    <button style="align-items: center; margin-bottom: 10px; margin-left: 70px" type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addAppointment">
                        <i class="fa fa-plus-square"></i></i>&nbsp; Add
                    </button>

                    <div id='calendar'></div>

                        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
                        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
                        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
                        <script>
                            $(document).ready(function() {
                                // page is now ready, initialize the calendar...
                                $('#calendar').fullCalendar({
                                    // put your options and callbacks here
                                    events : [
                                        @foreach($appointment as $item)
                                        {
                                            title : '{{ $item->lname }}, {{ $item->fname }}',
                                            start : '{{ $item->appointment_date }}',
                                            url : '{{ url('edit_appointments/'.$item->id) }}'
                                        },
                                        @endforeach
                                    ]
                                })
                            });
                        </script>


                </div>
            </div>
        </div>
    </div>
</div>

<!--addAppointment-->
<div class="modal fade" id="addAppointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div style="background: #008B8B; color: white" class="modal-header">
          Add Appointment
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/add_appointments') }}" method="POST">
            @csrf
            <div class="row">
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
              <div class="col-md-6">
                <div class="form-group">
                  <label for="description">Appointment Description</label>
                  <textarea type="text" name="description" class="form-control" id="description" placeholder="Document Description" required></textarea>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="appointment_date">Appointment Date</label>
                    <input type="date" min="<?php echo date("Y-m-d"); ?>" name="appointment_date" class="form-control date" id="datefield" placeholder="Document Description">
                  </div>
                </div>
              </div>
              <input type="text" value="2" name="status" hidden id="" placeholder="">
            <div style="align-items: baseline" class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

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

<footer class="c-footer">
    <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
    <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
</footer>
@endsection
