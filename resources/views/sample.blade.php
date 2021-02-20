@extends('layouts.app')
@section('content')
<button style="align-items: center; margin-bottom: 10px; margin-left: 70px" type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addAppointment">
    <i class="fa fa-plus-square"></i></i>&nbsp; Add
</button>

<div class="card">
    <table>
        <tbody>
        <tr>
            <th>S1</th>
            <th>Title</th>
            <th>View</th>
        </tr>
        @foreach ($file as $key=>$data)
        <tr>
            <td>{{++$key}}</td>
            <td>{{$data->title}}</td>
            <td><a type="button" href="/showsample/{{$data->id}}">View</a></td>
        </tr>  
        @endforeach
    </tbody>
    </table>
</div>
<a href="#">awdawd</a>








<!--addAppointment-->
<div class="modal fade" id="addAppointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div style="background: #008B8B; color: white" class="modal-header">
          Add sample
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/add_sample') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="applicant_id">title</label>
                    <input type="text" name="title">
                </div>
                </div>
              </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="description">file</label>
                  <input type="file" name="file" id="">
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
  @endsection
