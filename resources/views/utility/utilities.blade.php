@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    

@section('content')
<div class="row" style="align-items: center">
    <div class="col-9">
      <h6>Note: This is the page where you can manage add, edit, and delete utilities like permit/certificate names, document templates, and status descriptions.</h6>
    </div>
</div>

<div class="row">
    <div class="col-12 container2 border text-center mt-4 w-50">
    <h3 class="m-4 text-primary">Office Operation Utilities</h3>
  
  
    <div class="d-flex justify-content-center">

      <ul class="nav bg-light" role="tablist">
        <li class="nav-item">
          <a style="margin-left: -3px"  href="#step-1" id="step1-tab" class="nav-link active" aria-selected="true" data-toggle="tab" role="tab">Transaction Descriptions</a>
        </li>
        <li class="nav-item">
          <a style="margin-left: -10px; margin-right: -5px" href="#step-2" id="step2-tab" class="nav-link" aria-selected="false" data-toggle="tab" role="tab">Document Templates</a>
        </li>
        <li class="nav-item">
            <a   href="#step-3" id="step3-tab" class="nav-link" aria-selected="false" data-toggle="tab" role="tab">Status Descriptions</a>
        </li>
        <li class="nav-item">
          <a   href="#step-4" id="step4-tab" class="nav-link" aria-selected="false" data-toggle="tab" role="tab">Permit Templates</a>
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
                    <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="pull-left" id="req_search" type="text">
                  </div>
                  <div style="font-weight: 600; text-align:left; font-size: 20px; margin-left: -180px" class="col-5 card-header">Transaction Descriptions</div>
                  <div class="col-2 "><a href="{{url('/add_trandesc')}}" type="button" data-toggle="modal" data-target="#addTrandesc" class="btn btn-success"><i class="fa fa-plus"></i> Add</a></div>
                </div>
                    <table id="req_table" class="table table-striped ">
                        <thead class="thead-light">
                            <tr style="font-size: 12px">
                            <th style="width: 15%">Description ID</th>
                            <th style="width: 35%">Transaction Description</th>
                            <th style="width: 35%">Section</th>
                            <th style="width: 15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            @foreach ($trandesc as $item)
                            <tr style="font-size: 12px">
                              <td>{{ $item->id }}</td>
                              <td>{{ $item->tran_desc }}</td>
                              <td>{{ $item->section_desc }}</td>
                              <td>
                                    <button class="btn btn-outline-success" data-trandesc="{{$item->tran_desc}}" data-section="{{$item->section_id}}" data-tranid={{$item->id}} data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
                                 
                                  @if(Auth::user()->is_admin==1)
                               
                                    <button class="btn btn-outline-danger  remove-tran" data-id="{{ $item->id }}" data-action="{{ url('delete_trandesc/'.$item->id) }}"> <i class="fa fa-trash"></i></button>
                                
                                  @endif
                            
                              
                                {{-- <a href="{{ url('show_requestDocs/'.$item->id) }}" type="button" title="show" rel="tooltip" > 
                                  <i class="fa fa-eye"></i>
                                </a>&nbsp;
                                <a href="{{ url('edit_receiveDocs/'.$item->id) }}" type="button" title="edit" rel="tooltip" > 
                                  <i class="fa fa-edit"></i>
                                </a>&nbsp;
                                <a type="button" href="{{ url('accept_releaseDocs/'.$item->id)}}">Release</a> --}}
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
      <div class="tab-pane fade show " id="step-2" aria-labelledby="step2-tab" role="tabpanel">
        <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="card">
                <div class="row" style="align-items: center;">
                  <div class="col-6" style="margin-top: 10px">
                    <p class="pull-left" style="font-size: 17px; margin-right: 5px; margin-top: 2px; margin-left: 10px">Search </p>
                    <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="pull-left" id="req1_search" type="text">
                  </div>
                  <div style="font-weight: 600; text-align:left; font-size: 20px; margin-left: -180px" class="col-5 card-header">Document Descriptions</div>
                  <div class="col-2 "><a href="{{url('/add_docdesc')}}" type="button" data-toggle="modal" data-target="#addDocdesc" class="btn btn-success"><i class="fa fa-plus"></i> Add</a></div>
                </div>
                    <table id="req1_table" class="table table-striped">
                        <thead class="thead-light">
                            <tr style="font-size: 12px">
                            <th>Description ID</th>
                            <th>Document Description</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            @foreach ($docdesc as $item)
                            <tr style="font-size: 12px">
                              <td>{{ $item->id }}</td>
                              <td>{{ $item->doc_desc }}</td>
                              <td>
                                
                                <div class="row">
                                  <div class="col-3">
                                    <button class="btn btn-outline-success" data-docdesc="{{$item->doc_desc}}"  data-docid={{$item->id}} data-toggle="modal" data-target="#editDoc"><i class="fa fa-edit"></i></button>
                                    
                                  </div>
                                  @if(Auth::user()->is_admin==1)
                                  
                                  <div class="col-2" >
                                    <button class="btn btn-outline-danger  remove-docdesc" data-id="{{ $item->id }}" data-action="{{ url('delete_docdesc/'.$item->id) }}"> <i class="fa fa-trash"></i></button>
                                
                                  </div>
                                  @endif
                                </div>
                                
                                {{-- <a href="{{ url('show_requestDocs/'.$item->id) }}" type="button" title="show" rel="tooltip" > 
                                  <i class="fa fa-eye"></i>
                                </a>&nbsp;
                                <a href="{{ url('edit_receiveDocs/'.$item->id) }}" type="button" title="edit" rel="tooltip" > 
                                  <i class="fa fa-edit"></i>
                                </a>&nbsp;
                                <a type="button" href="{{ url('accept_releaseDocs/'.$item->id)}}">Release</a> --}}
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
      <div class="tab-pane fade show " id="step-3" aria-labelledby="step3-tab" role="tabpanel">
        
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="card">
              <div class="row" style="align-items: center;">
                <div class="col-6" style="margin-top: 10px">
                  <p class="pull-left" style="font-size: 17px; margin-right: 5px; margin-top: 2px; margin-left: 10px">Search </p>
                  <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="pull-left" id="req2_search" type="text">
                </div>
                <div style="font-weight: 600; text-align:left; font-size: 20px; margin-left: -180px" class="col-5 card-header">Status Descriptions</div>
                <div class="col-2 "><a href="{{url('/add_statusdesc')}}" type="button" data-toggle="modal" data-target="#addStatusdesc" class="btn btn-success"><i class="fa fa-plus"></i> Add</a></div>
              </div>
                  <table id="req2_table" class="table table-striped">
                      <thead class="thead-light">
                          <tr style="font-size: 12px">
                          <th>Description ID</th>
                          <th>Status Description</th>
                          <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                          @foreach ($status as $item)
                          <tr style="font-size: 12px">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->status_name }}</td>
                            <td>
                              
                              <div class="row">
                                <div class="col-2">
                                  <button class="btn btn-outline-success" data-statusdesc="{{$item->status_name}}"  data-statusid={{$item->id}} data-toggle="modal" data-target="#editStatus"><i class="fa fa-edit"></i></button>
                                  
                                </div>
                                @if(Auth::user()->is_admin==1)
                                
                                <div class="col-2" >
                                  <button style="margin-left: -10px" class="btn btn-outline-danger  remove-status" data-id="{{ $item->id }}" data-action="{{ url('delete_statusdesc/'.$item->id) }}"> <i class="fa fa-trash"></i></button>
                              
                                </div>
                                @endif
                              </div>
                              {{-- <a href="{{ url('show_requestDocs/'.$item->id) }}" type="button" title="show" rel="tooltip" > 
                                <i class="fa fa-eye"></i>
                              </a>&nbsp;
                              <a href="{{ url('edit_receiveDocs/'.$item->id) }}" type="button" title="edit" rel="tooltip" > 
                                <i class="fa fa-edit"></i>
                              </a>&nbsp;
                              <a type="button" href="{{ url('accept_releaseDocs/'.$item->id)}}">Release</a> --}}
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

        <script>
          $(document).ready(function(){
            $('#req1_search').keyup(function(){
              search_table($(this).val());
            });

            function search_table(value){
              $('#req1_table tr').each(function(){
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

        <script>
          $(document).ready(function(){
            $('#req2_search').keyup(function(){
              search_table($(this).val());
            });

            function search_table(value){
              $('#req2_table tr').each(function(){
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

    <div class="tab-pane fade show " id="step-4" aria-labelledby="step4-tab" role="tabpanel">
        
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12">
          <div class="card">
            <div class="row" style="align-items: center;">
              <div class="col-6" style="margin-top: 10px">
                <p class="pull-left" style="font-size: 17px; margin-right: 5px; margin-top: 2px; margin-left: 10px">Search </p>
                <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="pull-left" id="req3_search" type="text">
              </div>
              <div style="font-weight: 600; text-align:left; font-size: 20px; margin-left: -180px" class="col-5 card-header">Certificates/Permit Template</div>
              <div class="col-2 "><a href="{{url('/add_statusdesc')}}" type="button" data-toggle="modal" data-target="#addPermit" class="btn btn-success"><i class="fa fa-plus"></i> Add</a></div>
            </div>
                <table id="req3_table" class="table table-striped">
                    <thead class="thead-light">
                        <tr style="font-size: 12px">
                        <th>Description ID</th>
                        <th>Certificate/Permit Description</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($release as $item)
                        <tr style="font-size: 12px">
                          <td>{{ $item->id }}</td>
                          <td>{{ $item->doc_desc }}</td>
                          <td>
                            
                            <div class="row">
                              <div class="col-2">
                                <button class="btn btn-outline-success" data-statusdesc="{{$item->doc_desc}}"  data-permitid={{$item->id}} data-toggle="modal" data-target="#editPermit"><i class="fa fa-edit"></i></button>
                              </div>
                              
                              @if(Auth::user()->is_admin==1)
                                <div class="col-2" >
                                  <button class="btn btn-outline-danger  remove-permit" data-id="{{ $item->id }}" data-action="{{ url('delete_permitDoc/'.$item->id) }}"> <i class="fa fa-trash"></i></button>
                              
                                </div>
                              @endif
                            </div>
                            {{-- <a href="{{ url('show_requestDocs/'.$item->id) }}" type="button" title="show" rel="tooltip" > 
                              <i class="fa fa-eye"></i>
                            </a>&nbsp;
                            <a href="{{ url('edit_receiveDocs/'.$item->id) }}" type="button" title="edit" rel="tooltip" > 
                              <i class="fa fa-edit"></i>
                            </a>&nbsp;
                            <a type="button" href="{{ url('accept_releaseDocs/'.$item->id)}}">Release</a> --}}
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

      <script>
        $(document).ready(function(){
          $('#req1_search').keyup(function(){
            search_table($(this).val());
          });

          function search_table(value){
            $('#req1_table tr').each(function(){
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

      <script>
        $(document).ready(function(){
          $('#req2_search').keyup(function(){
            search_table($(this).val());
          });

          function search_table(value){
            $('#req2_table tr').each(function(){
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

<script>
  $(document).ready(function(){
    $('#req3_search').keyup(function(){
      search_table($(this).val());
    });

    function search_table(value){
      $('#req3_table tr').each(function(){
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
  
    </div>
  </div>
</div>

<!--add trandesc-->
<div class="modal fade" id="addTrandesc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="background: #008B8B; color: white" class="modal-header">
        Add Transaction Description
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('/add_trandesc') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label for="tran_desc">Transaction Description</label>
                <textarea type="text" name="tran_desc" class="form-control" id="description" ></textarea>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <label for="section_id">Section</label>
                  <select name="section_id" id="section_id" class="form-control" required>
                      @foreach($section as $item)
                      <option value="{{ $item->id }}">{{$item->section_desc}}</option>
                      @endforeach
                  </select>
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

<!--add docdesc-->
<div class="modal fade" id="addDocdesc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="background: #008B8B; color: white" class="modal-header">
        Add Document Description
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('/add_docdesc') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label for="doc_desc">Document Description</label>
                <textarea type="text" name="doc_desc" class="form-control" id="doc_desc" ></textarea>
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

<!--add statusdesc-->
<div class="modal fade" id="addStatusdesc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="background: #008B8B; color: white" class="modal-header">
        Add Status Description
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('/add_statusdesc') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label for="status_desc">Status Description</label>
                <textarea type="text" name="status_desc" class="form-control" id="status_desc" ></textarea>
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

<!--add permitTemp-->
<div class="modal fade" id="addPermit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="background: #008B8B; color: white" class="modal-header">
        Add Certificate/Permit Template
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('/store_permitTemp') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label for="doc_desc">Certificate/Permit Description</label>
                <textarea type="text" name="doc_desc" class="form-control" id="doc_desc" ></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="file">File for Cert/Permit Template</label>
                <input type="file" name="file" class="form-control" id="file">
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
              <form action="{{ url('/edit_trandesc')}}" method="post">
                  {{method_field('patch')}}
                  {{csrf_field()}}
                <div class="modal-body">
                    <input type="hidden" name="tran_id" id="tran_id" value="">
                @include('utility.trandescform')
               
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>

<!-- Edit docu Modal -->
<div class="modal fade" id="editDoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title pull-left" id="myModalLabel">Edit Document Description</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{ url('/edit_docdesc')}}" method="post">
          {{method_field('patch')}}
          {{csrf_field()}}
        <div class="modal-body">
            <input type="hidden" name="doc_id" id="doc_id" value="">
        @include('utility.docdescform')
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit status Modal -->
<div class="modal fade" id="editStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title pull-left" id="myModalLabel">Edit Document Description</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{ url('/edit_statusdesc')}}" method="post">
          {{method_field('patch')}}
          {{csrf_field()}}
        <div class="modal-body">
            <input type="hidden" name="status_id" id="status_id" value="">
        @include('utility.statusdescform')
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Permit Modal -->
<div class="modal fade" id="editPermit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title pull-left" id="myModalLabel">Edit Cert/Permit Template</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{ url('/edit_permitTemp')}}" method="post" enctype="multipart/form-data">
          {{method_field('patch')}}
          {{csrf_field()}}
        <div class="modal-body">
            <input type="hidden" name="permit_id" id="permit_id" value="">
        @include('utility.permitForm')
       
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
      var trandesc = button.data('trandesc') 
      var section = button.data('section') 
      var tranid = button.data('tranid') 
      var modal = $(this)
      modal.find('.modal-body #tran_desc').val(trandesc);
      modal.find('.modal-body #section').val(section);
      modal.find('.modal-body #tran_id').val(tranid);
})
</script>

<script>
  $('#editDoc').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) 
    var docdesc = button.data('docdesc') 
    var docid = button.data('docid') 
    var modal = $(this)
    modal.find('.modal-body #doc_desc').val(docdesc);
    modal.find('.modal-body #doc_id').val(docid);
})
</script>

<script>
  $('#editStatus').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) 
    var statusdesc = button.data('statusdesc') 
    var statusid = button.data('statusid') 
    var modal = $(this)
    modal.find('.modal-body #status_desc').val(statusdesc);
    modal.find('.modal-body #status_id').val(statusid);
})
</script>

<script>
  $('#editPermit').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) 
    var doc_desc = button.data('statusdesc') 
    var permitid = button.data('permitid') 
    var file = button.data('file')
    var modal = $(this)
    modal.find('.modal-body #doc_desc').val(doc_desc);
    modal.find('.modal-body #permit_id').val(permitid);
    modal.find('.modal-body #file').val(file);
})
</script>



<script type="text/javascript">
  $("body").on("click",".remove-permit", function(){
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

  $("body").on("click",".remove-docdesc", function(){
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

  $("body").on("click",".remove-status", function(){
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
@endsection