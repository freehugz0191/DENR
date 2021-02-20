@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.min.css" integrity="sha512-A374yR9LJTApGsMhH1Mn4e9yh0ngysmlMwt/uKPpudcFwLNDgN3E9S/ZeHcWTbyhb5bVHCtvqWey9DLXB4MmZg==" crossorigin="anonymous" />
@section('content')
<div class="container">
  <h3 style="text-align: center">Applicants or Clients List</h3>
    <div  class="row justify-content-center">
      <div class="col-md-10">
           
      </div>
        <div class="col-md-2">
            <button style="align-items: center; margin-bottom: 10px; margin-left: 20px;" type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addApplicant">
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
                <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="col-3" id="applicant_search" type="text">
            </div>
                <div style="font-weight: 700" class="card-header">Manage Applicants List</div>
                    <table id="applicant_table" class="table table-striped">
                        <thead class="thead-dark">
                            <tr style="font-size: 12px">
                            <th scope="col">Applicant ID</th>
                            <th scope="col">Firstname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Address</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applicant as $item)
                                <tr style="font-size: 12px">
                                    
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->fname }}</td>
                                    <td>{{ $item->lname }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->contact }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>
                                      <a href="{{ url('show_applicants/'.$item->id) }}" class="btn btn-outline-info btn-sm" type="button" title="show" rel="tooltip" > 
                                        <i class="fa fa-eye"></i>
                                      </a>&nbsp;
                                      <a href="{{ url('edit_applicants/'.$item->id) }}" class="btn btn-outline-success btn-sm" type="button" title="edit" rel="tooltip" > 
                                        <i class="fa fa-edit"></i>
                                      </a>&nbsp;
                                      
                                      
                                    </td>
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p> &nbsp;&nbsp;Showing {{ $applicant->count() }} out of {{ $applicant->total() }} results.</p>
                    <div style="margin-left: 10px"> {{ $applicant->links() }}</div>
                   </div>
        </div>
    </div>
</div>
<script>
  $(document).ready(function(){
    $('#applicant_search').keyup(function(){
      search_table($(this).val());
    });

    function search_table(value){
      $('#applicant_table tr').each(function(){
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
<!--addApplicant-->
<div class="modal fade" id="addApplicant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="background: #008B8B; color: white" class="modal-header">
        Add Applicant
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="font-weight: 700">
        <form action="{{ url('/add_applicants') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="fname">Firstname</label>
                <input type="text" name="fname" class="form-control" id="fname" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="lname">Lastname</label>
                <input type="text" name="lname" class="form-control" id="lname" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" name="contact" class="form-control" id="contact" >
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control" required>
      
                  <option value="m">Male</option>
                  <option value="f">Female</option>
            
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password">
              </div>
            </div>
          </div>
         
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label for="address">Address</label>
                  <input type="address" name="address" class="form-control" id="email" >
              </div>
            </div>
          </div>
   
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label for="address">Birth Date</label>
                  <input type="date" name="day_birth" class="form-control" id="day_birth">
              </div>
            </div>
          </div>

          <div style="align-items: baseline" class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success sweet">Submit</button>
          </div>    
        </form>
      </div>
    </div>
  </div>
</div>

<!--showApplicant-->
<div class="modal fade" id="showApplicant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            Show Applicant
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          
        </div>
    </div>
    </div>
</div>
<footer class="c-footer">
  <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
  <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
</footer>

<script>

$(document).ready(function(){

  $(document).on('click', '.sweet', function(){
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Applicant has been saved',
      showConfirmButton: false,
      timer: 1500
      })
  });

});


</script>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.min.js" integrity="sha512-tiZ8585M9G8gIdInZMGGXgEyFdu8JJnQbIcZYHaQxq+MP4+T8bkvA+TfF9BjPmiePjhBhev3bQ6nloOB1zF9EA==" crossorigin="anonymous"></script>

@endsection