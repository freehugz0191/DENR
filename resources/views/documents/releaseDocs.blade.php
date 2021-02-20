@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


  <style>
    .bot2 {
      transition: transform .2s; /* Animation */
      
    }
    
    .bot2:hover{
      transform: scale(1.2);
    }
    
  </style>
@section('content')


    {{-- <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div style="padding: 10px; font-size:12px" class="row">
                    <div class="col-sm-4 bot2"><button style="margin-top: -20px; margin-left: 10px" name="bot2" class="btn btn-success" data-toggle="modal" data-target="#addDocument"><i style="font-size: 30px; width: 30px; height:30px; color:white" class="fa fa-plus"></i></button></div>
                    <div style="font-weight:600; margin-left:10px" class="col-sm-5">Add Document Type</div>
                </div>
                
            </div>
        </div>
        <div class="col-md-3">
          <div class="card">
              <div style="padding: 10px; font-size:12px" class="row">
                  <div class="col-sm-4 bot2"><button style="margin-top: -20px; margin-left: 10px" name="bot2" class="btn btn-primary" data-toggle="modal" data-target="#receiveDocument"><i style="font-size: 30px; width: 30px; height:30px; color:white" class="fa fa-plus"></i></button></div>
                  <div style="font-weight:600; margin-left:10px" class="col-sm-5">Receive New Document</div>
              </div>
              
          </div>
      </div>
        <div class="col-md-3">
            <div class="card">
                <div style="padding: 10px; font-size:12px" class="row">
                    <div class="col-sm-4 bot2"><button style="margin-top: -20px; margin-left: 10px" name="bot2" class="btn btn-warning" data-toggle="modal" data-target="#requestDocument"><i style="font-size: 30px; width: 30px; height:30px; color:white" class="fa fa-plus"></i></button></div>
                    <div style="font-weight:600; margin-left:10px " class="col-sm-5">Request Release Document</div>
                </div>
                
            </div>
        </div>
        <div class="col-md-3">
          <div class="card">
              <div style="padding: 10px; font-size:12px" class="row">
                  <div class="col-sm-4 bot2"><button style="margin-top: -20px; margin-left: 10px" name="bot2" class="btn btn-danger" data-toggle="modal" data-target="#DocumentTemp"><i style="font-size: 30px; width: 30px; height:30px; color:white" class="fa fa-plus"></i></button></div>
                  <div style="font-weight:600; margin-left:10px" class="col-sm-5">Release Document Template</div>
              </div>
              
          </div>
      </div>
    </div> --}}
    <div class="row" style="align-items: center">
      <div class="col-9">
        <h6>Note: This is the page where you can request documents that only admin can able to release.</h6>
      </div>
     
    </div>
    <div class="row">
      <div class="col-12 container2 border text-center mt-4 w-50">
      <h3 class="m-4 text-primary">Release Documents</h3>
    
    
      <div class="d-flex justify-content-center">

        <ul class="nav bg-light" role="tablist">
          <li class="nav-item">
            <a href="#step-1" id="step1-tab" class="nav-link active" aria-selected="true" data-toggle="tab" role="tab">Approved Transactions</a>
          </li>
          <li class="nav-item">
            <a  href="#step-2" id="step2-tab" class="nav-link" aria-selected="false" data-toggle="tab" role="tab">Approved Documents</a>
          </li>
          <li class="nav-item">
              <a   href="#step-3" id="step3-tab" class="nav-link" aria-selected="false" data-toggle="tab" role="tab">Pending Documents</a>
          </li>
          <div class="panel rounded"></div>
        </ul>

      </div>
    
      <div class="tab-content">
        <div class="tab-pane fade show active" id="step-1" aria-labelledby="step1-tab" role="tabpanel">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="card">
                  <div class="row" style="align-items: center;">
                    <div class="col-6" style="margin-top: 10px">
                      <p class="pull-left" style="font-size: 17px; margin-right: 5px; margin-top: 2px; margin-left: 10px">Search </p>
                      <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="pull-left" id="doc_app_search" type="text">
                    </div>
                    <div style="font-weight: 600; text-align:center; font-size: 20px; margin-left: -180px" class="col-4 card-header">Approved Transactions</div>
                  </div>
                    <table id="doc_app_table" class="table table-striped ">
                      <thead class="thead-light">
                        <tr style="font-size: 12px">
                          <th style="width: 110px" scope="col">Transaction ID</th>
                          <th style="width: 110px" scope="col">Applicant </th>
                          <th scope="col">Address</th>
                          <th scope="col">Status</th>
                          <th scope="col">Remarks</th>
                          <th style="width: 100px; text-align:center" scope="col">Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                          @foreach ($document as $item)
                          <tr style="font-size: 12px">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->lname }}, {{ $item->fname }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->status_name }}</td>
                            <td>{{ $item->remarks }}</td>
                            <td >
                              <a href="" class="btn btn-outline-success btn-sm" style="padding: 10px" data-tran_id="{{$item->id}}" data-toggle="modal" data-target="#requestDocument"><i class="fa fa-plus"></i> <span>Request Document</span></a>
                            </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>

          <script>
            $(document).ready(function(){
              $('#doc_app_search').keyup(function(){
                search_table($(this).val());
              });
      
              function search_table(value){
                $('#doc_app_table tr').each(function(){
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
          
        </div>
        <div class="tab-pane fade show " id="step-2" aria-labelledby="step2-tab" role="tabpanel">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="card">
                  <div class="row" style="align-items: center;">
                    <div class="col-6" style="margin-top: 10px">
                      <p class="pull-left" style="font-size: 17px; margin-right: 5px; margin-top: 2px; margin-left: 10px">Search </p>
                      <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="pull-left" id="approved_search" type="text">
                    </div>
                    <div style="font-weight: 600; text-align:center; font-size: 20px; margin-left: -180px" class="col-5 card-header">Documents Approved for Release</div>
                  </div>
                  <table id="approved_table" class="table table-striped">
                    <thead class="thead-light">
                        <tr style="font-size: 12px">
                        <th>Request ID</th>
                        <th>Document Template</th>
                        <th>Transaction ID</th>
                        <th>Status</th>
                        <th >Remarks</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($documentApproved as $item)
                        <tr style="font-size: 12px">
                          <td>{{ $item->id }}</td>
                          <td>{{ $item->doc_desc }}</td>
                          <td>{{ $item->tran_id }}</td>
                          <td>{{ $item->status_name }}</td>
                          <td >{{ $item->remarks }}</td>
                          <td >
                            <a href="{{ url('show_requestDocs/'.$item->id) }}" type="button" class="btn btn-outline-info btn-sm" title="show" rel="tooltip" > 
                              <i class="fa fa-eye"></i>
                            </a>&nbsp;
                            <button class="btn btn-outline-success btn-sm" data-reldoc_id="{{$item->reldoc_id}}" data-remarks="{{$item->remarks}}" data-tran_id={{$item->tran_id}} data-req_id={{$item->id}} data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
              </div>
            </div>
          </div>

          <script>
            $(document).ready(function(){
              $('#approved_search').keyup(function(){
                search_table($(this).val());
              });
      
              function search_table(value){
                $('#approved_table tr').each(function(){
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

        </div>
        <div class="tab-pane fade show " id="step-3" aria-labelledby="step3-tab" role="tabpanel">
          @if(auth()->user()->is_admin == 1)
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="card">
              <div class="row" style="align-items: center;">
                <div class="col-6" style="margin-top: 10px">
                  <p class="pull-left" style="font-size: 17px; margin-right: 5px; margin-top: 2px; margin-left: 10px">Search </p>
                  <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="pull-left" id="req_search" type="text">
                </div>
                <div style="font-weight: 600; text-align:center; font-size: 20px; margin-left: -180px" class="col-4 card-header">Requested Documents</div>
              </div>
                  <table id="req_table" class="table table-striped">
                      <thead class="thead-light">
                          <tr style="font-size: 12px">
                          <th>Request ID</th>
                          <th>Document Template</th>
                          <th>Transaction ID</th>
                          <th>Status</th>
                          <th >Remarks</th>
                          <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                          @foreach ($documentPending as $item)
                          <tr style="font-size: 12px">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->doc_desc }}</td>
                            <td>{{ $item->tran_id }}</td>
                            <td>{{ $item->status_name }}</td>
                            <td >{{ $item->remarks }}</td>
                            <td >
                              <a href="{{ url('show_requestDocs/'.$item->id) }}" type="button" class="btn btn-outline-info btn-sm" title="show" rel="tooltip" > 
                                <i class="fa fa-eye"></i>
                              </a>&nbsp;
                              <button style="margin-right: 4px" class="btn btn-outline-success btn-sm" data-reldoc_id="{{$item->reldoc_id}}" data-remarks="{{$item->remarks}}" data-tran_id={{$item->tran_id}} data-req_id={{$item->id}} data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
                             
                            </td>
                          </tr>
                          @endforeach
                        
                      </tbody>
                  </table>
            </div>
          </div>
          </div>
        </div>

        <script>
          $(document).ready(function(){
            $('#req_search').keyup(function(){
              search_table($(this).val());
            });
    
            function search_table(value){
              $('#req_table tr').each(function(){
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


        @else
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                <div class="row" style="align-items: center;">
                  <div class="col-6" style="margin-top: 10px">
                    <p class="pull-left" style="font-size: 17px; margin-right: 5px; margin-top: 2px; margin-left: 10px">Search </p>
                    <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="pull-left" id="req_search" type="text">
                  </div>
                  <div style="font-weight: 600; text-align:center; font-size: 20px; margin-left: -150px" class="col-4 card-header">Pending Requested Documents</div>
                </div>
                  <table id="req_table" class="table table-striped">
                      <thead class="thead-light">
                          <tr style="font-size: 12px">
                          <th>Request ID</th>
                          <th>Document Template</th>
                          <th>Transaction ID</th>
                          <th>Status</th>
                          <th>Remarks</th>
                          <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                          @foreach ($documentPending as $item)
                          <tr style="font-size: 12px">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->doc_desc }}</td>
                            <td>{{ $item->tran_id }}</td>
                            <td>{{ $item->status_name }}</td>
                            <td >{{ $item->remarks }}</td>
                            <td >
                              @if (auth()->user()->is_admin == 1)
                                <a href="{{ url('show_requestDocs/'.$item->id) }}" type="button" class="btn btn-outline-info btn-sm" title="show" rel="tooltip" > 
                                  <i class="fa fa-eye"></i>
                                </a>&nbsp; 
                              @endif
                              <button class="btn btn-outline-success btn-sm" data-reldoc_id="{{$item->reldoc_id}}" data-remarks="{{$item->remarks}}" data-tran_id={{$item->tran_id}} data-req_id={{$item->id}} data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
                            </td>
                          </tr>
                          @endforeach
                        
                          
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <script>
              $(document).ready(function(){
                $('#req_search').keyup(function(){
                  search_table($(this).val());
                });
        
                function search_table(value){
                  $('#req_table tr').each(function(){
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

        @endif
      </div>
    
      </div>
    </div>
</div>
      


<!--RequestDoc-->
<div class="modal fade" id="requestDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="background: #008B8B; color: white" class="modal-header">
        Request Document for Release
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('/add_requestDocs') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-9">
                <div class="form-group">
                  <label for="reldoc_id">Document Type</label>
                  <select name="reldoc_id" id="reldoc_id" class="form-control" required>
                  @foreach($reldoc as $item)
                      <option value="{{ $item->id }}">{{ $item->doc_desc }}</option>
                  @endforeach
                  </select></div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="tran_id">Transaction Id</label>
                  <input readonly class="form-control" type="text" name="tran_id" id="tran_id">
              </div>
            </div>
            <div class="row">
              <div class="col-md-9">
                <div class="form-group">
                  <label for="remarks">Remarks</label>
                  <textarea name="remarks" id="remarks" class="form-control"></textarea>
                </div>
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

<!-- Edit Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title pull-left" id="myModalLabel">Edit Transaction Description</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{ url('/update_relDoc')}}" method="post">
          {{method_field('patch')}}
          {{csrf_field()}}
        <div class="modal-body">
            <input type="hidden" name="req_id" id="req_id" value="">
            <div class="form-group">
              <label for="tran_id">Transaction ID</label>
              <input type="text" class="form-control" name="tran_id" id="tran_id">
            </div>
            <div class="form-group">
              <label for="reldoc_id">Procedure</label>
              <select name="reldoc_id" id="reldoc_id" class="form-control" required>
                  @foreach($reldoc as $item)
                  <option value="{{ $item->id }}">{{ $item->doc_desc }}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="remarks">Remarks</label>
              <textarea type="text" class="form-control" name="remarks" id="remarks"></textarea>
            </div>
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>



<footer class="c-footer">
  <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
  <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 <script src="assets/js/main.js"></script>


 <script>
  $('#edit').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) 
    var tran_id = button.data('tran_id') 
    var req_id = button.data('req_id') 
    var reldoc_id = button.data('reldoc_id') 
    var remarks = button.data('remarks') 
    var modal = $(this)
    modal.find('.modal-body #req_id').val(req_id);
    modal.find('.modal-body #remarks').val(remarks);
    modal.find('.modal-body #reldoc_id').val(reldoc_id);
    modal.find('.modal-body #tran_id').val(tran_id);
})
</script>

<script>
  $('#requestDocument').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) 
    var tran_id = button.data('tran_id') 
    var modal = $(this)
    modal.find('.modal-body #tran_id').val(tran_id);
})
</script>

<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>
@endsection