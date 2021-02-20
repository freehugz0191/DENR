@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <style>
    .bot2 {
      transition: transform .2s; /* Animation */
      
    }
    
    .bot2:hover{
      transform: scale(1.2);
    }

    #table tr
    {
      cursor: pointer;
      transition: all .25s ease-in-out;

    }

    #table tr:hover
    {
      background-color:  rgba(45, 235, 235, 0.588);
    }
  </style>
@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
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
        <h6>Note: This is the page where you can receive documents that are submitted by clients. Also in this page you can transfer documents to other departments.</h6>
      </div>
      <div class="col-3">
        <a href="" class="btn btn-outline-success" style="padding: 10px" data-toggle="modal" data-target="#receiveDocument"><i class="fa fa-folder-open"></i> <span>Receive Document</span></a>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-11 container2 border text-center mt-4 w-50">
      <h3 class="m-4 text-primary">Receive Documents</h3>
      </div>
    </div>
    @if(auth()->user()->is_admin == null)
      @if (auth()->user()->dept_id == null)
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                <div style="font-weight: 600; text-align:center; font-size: 20px" class="card-header">Receive Documents</div>
                  <table class="table table-striped">
                    
                      <h1 style="text-align: center; padding: 20px">Nothing to show</h1>
                    
                  </table>
              </div>
            </div>
          </div>
        </div>
      @else
        
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                <div class="row" style="align-items: center;">
                  <div class="col-6" style="margin-top: 10px">
                    <p class="pull-left" style="font-size: 17px; margin-right: 5px; margin-top: 2px; margin-left: 10px">Search </p>
                    <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="pull-left" id="rec_search" type="text">
                  </div>
                  <div style="font-weight: 600; text-align:center; font-size: 20px; margin-left: -180px" class="col-4 card-header">Pending to receive documents</div>
                </div>
                  <table id="rec_table"  class="table table-striped">
                      <thead class="thead-dark">
                          <tr style="font-size: 12px">
                            <th style="width: 100px" scope="col">Document ID</th>
                            <th style="width: 100px" scope="col">Document type</th>
                            <th style="width: 130px" scope="col">Transaction ID</th>
                            <th style="width: 100px" scope="col">Status</th>
                            <th style="width: 150px" scope="col">Remarks</th>
                            <th style="width: 200px" scope="col">Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                        @foreach ($document as $item)
                          <tr style="font-size: 12px">
                                    
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->doc_desc }}</td>
                            <td>{{ $item->tran_id }}</td>
                            <td>{{ $item->status_desc }}</td>
                            <td>{{ $item->remarks }}</td>
                            <td>
                              <form action="{{ url('accept_receiveDocs/'.$item->id) }}">
                                @csrf
                                @method('PATCH')
                                <input name="user_id" type="text" hidden value="{{$item->sender}}">
                                <button type="submit" class="btn btn-outline-success btn-sm">Receive</button>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
                  <p>&nbsp;&nbsp;Showing {{ $document->count() }} out of {{ $document->total() }} results.</p>
                    <div> {{ $document->links() }}</div>
              </div>
            </div>
          </div>
        </div>
      @endif
    @else

    @endif
    <script>
      $(document).ready(function(){
        $('#rec_search').keyup(function(){
          search_table($(this).val());
        });

        function search_table(value){
          $('#rec_table tr').each(function(){
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
    <br><br>
    @if(auth()->user()->is_admin == 1)
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="row" style="align-items: center;">
              <div class="col-6" style="margin-top: 10px">
                <p class="pull-left" style="font-size: 17px; margin-right: 5px; margin-top: 2px; margin-left: 10px">Search </p>
                <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="pull-left" id="rec_search" type="text">
              </div>
              <div style="font-weight: 600; text-align:center; font-size: 20px; margin-left: -180px" class="col-4 card-header">Pending to receive documents</div>
            </div>
              <table id="rec_table"  class="table table-striped">
                  <thead class="thead-dark">
                      <tr style="font-size: 12px">
                        <th style="width: 100px" scope="col">Document ID</th>
                        <th style="width: 100px" scope="col">Document type</th>
                        <th style="width: 130px" scope="col">Transaction ID</th>
                        <th style="width: 100px" scope="col">Status</th>
                        <th style="width: 150px" scope="col">Remarks</th>
                        <th style="width: 200px" scope="col">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($document as $item)
                      <tr style="font-size: 12px">
                                
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->doc_desc }}</td>
                        <td>{{ $item->tran_id }}</td>
                        <td>{{ $item->status_desc }}</td>
                        <td>{{ $item->remarks }}</td>
                        <td>
                          <form action="{{ url('accept_receiveDocs/'.$item->id) }}">
                            @csrf
                            @method('PATCH')
                            <input name="user_id" type="text" hidden value="{{$item->sender}}">
                            <button type="submit" class="btn btn-outline-success btn-sm">Receive</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              <p>&nbsp;&nbsp;Showing {{ $document->count() }} out of {{ $document->total() }} results.</p>
                <div> {{ $document->links() }}</div>
          </div>
        </div>
      </div>
    </div>
    <br><br>
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="row" style="align-items: center;">
                <div class="col-6" style="margin-top: 10px">
                  <p class="pull-left" style="font-size: 17px; margin-right: 5px; margin-top: 2px; margin-left: 10px">Search </p>
                  <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="pull-left" id="doc_on_hand_search" type="text">
                </div>
                <div style="font-weight: 600; text-align:center; font-size: 20px; margin-left: -180px" class="col-4 card-header">Documents on hand</div>
              </div>
                  <table id="doc_on_hand_table" border="1" class="table table-striped">

                      
                        <thead class="thead-dark">
                          <tr style="font-size: 12px">
                            <th style="width: 100px" scope="col">Document ID</th>
                            <th style="width: 100px" scope="col">Document type</th>
                            <th style="width: 130px" scope="col">Transaction ID</th>
                            <th style="width: 100px" scope="col">Status</th>
                            <th style="width: 150px" scope="col">Remarks</th>
                            <th style="width: 200px" scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                          @foreach ($documentOnhand as $item)
                              <tr style="font-size: 12px; text-align:baseline">
                                  
                                  <td>{{ $item->id }}</td>
                                  <td>{{ $item->doc_desc }}</td>
                                  <td>{{ $item->tran_id }}</td>
                                  <td>{{ $item->status_desc }}</td>
                                  <td>{{ $item->remarks }}</td>
                                  <td>
                                    <a href="{{ url('show_receiveDocs/'.$item->id) }}" type="button" title="show" rel="tooltip" > 
                                      <i class="fa fa-eye"></i>
                                    </a>&nbsp;
                                    <a href="{{ url('edit_receiveDocs/'.$item->id) }}" type="button" title="edit" rel="tooltip" > 
                                      <i class="fa fa-edit"></i>
                                    </a>&nbsp;
                                    {{-- <form action="{{ url('update_dept/'.$item->id) }}">
                                      @csrf
                                      @method('PATCH')
                                      <select style="width: 100px" name="dept_id" id="">
                                        <option value=""></option>
                                        @foreach ($department as $item)
                                        <option value="{{ $item->id }}">{{ $item->dept_desc }}</option>
                                        @endforeach
                                      </select>
                                      <button style="border: none" type="submit">Send</button>
                                    </form> --}}
                                  </td>
                              </tr>
                          @endforeach
                          </tbody>
                        </table>
                          <p>&nbsp;&nbsp;Showing {{ $document->count() }} out of {{ $document->total() }} results.</p>
                            <div> {{ $document->links() }}</div>
            </div>
          </div>
        </div>
      </div>

    @else
      <div class="container">
        
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="row" style="align-items: center;">
                <div class="col-6" style="margin-top: 10px">
                  <p class="pull-left" style="font-size: 17px; margin-right: 5px; margin-top: 2px; margin-left: 10px">Search </p>
                  <input style="font-size: 15px; padding-left: 8px; height: 31px; margin-right: 3px" class="pull-left" id="doc_on_hand_search" name="doc_on_hand_search" type="text">
                </div>
                <div style="font-weight: 600; text-align:center; font-size: 20px; margin-left: -180px" class="col-4 card-header">Documents on hand</div>
              </div>
             
                <table id="doc_on_hand_table" border="1" class="table table-striped">
                
                    @if(auth()->user()->dept_id != null)
                    <thead class="thead-dark">
                      <tr style="font-size: 12px">
                        <th style="width: 100px" scope="col">Document ID</th>
                        <th style="width: 100px" scope="col">Document type</th>
                        <th style="width: 130px" scope="col">Transaction ID</th>
                        <th style="width: 100px" scope="col">Status</th>
                        <th style="width: 150px" scope="col">Remarks</th>
                        <th style="width: 200px" scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($documentOnhand as $item)
                        <tr style="font-size: 12px">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->doc_desc }}</td>
                            <td>{{ $item->tran_id }}</td>
                            <td>{{ $item->status_desc }}</td>
                            <td>{{ $item->remarks }}</td>
                            <td>
                              <a href="{{ url('show_receiveDocs/'.$item->id) }}" type="button" title="show" rel="tooltip" > 
                                <i class="fa fa-eye"></i>
                              </a>&nbsp;
                              <a href="{{ url('edit_receiveDocs/'.$item->id) }}" type="button" title="edit" rel="tooltip" > 
                                <i class="fa fa-edit"></i>
                              </a>&nbsp;
                              {{-- <form action="{{ url('update_dept/'.$item->id) }}">
                                @csrf
                                @method('PATCH')
                                <select style="width: 100px" name="dept_id" id="">
                                  <option value=""></option>
                                  @foreach ($department as $item)
                                  <option value="{{ $item->id }}">{{ $item->dept_desc }}</option>
                                  @endforeach
                                </select>
                                <button style="border: none" type="submit">Send</button>
                              </form> --}}
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                    </table>
                      <p>&nbsp;&nbsp;Showing {{ $documentOnhand->count() }} out of {{ $documentOnhand->total() }} results.</p>
                      <div> {{ $documentOnhand->links() }}</div>
                    @else
                        <h1 style="text-align: center; padding: 20px">Nothing to show</h1>
                    @endif
                    
            </div>
          </div>
        </div>
      </div>   
    @endif

    <script>
      $(document).ready(function(){
        $('#doc_on_hand_search').keyup(function(){
          search_table($(this).val());
        });

        function search_table(value){
          $('#doc_on_hand_table tr').each(function(){
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
{{-- </div>  --}}

<!--addDoc-->
<div class="modal fade" id="addDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div style="background: #008B8B; color: white" class="modal-header">
          Add Document Type
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/add_doctype') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="doc_desc">Document Description</label>
                  <input type="text" name="doc_desc" class="form-control" id="doc_desc" placeholder="Document Description">
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

  <!--ReceiveDoc-->
<!--ReceiveDoc-->
<div class="modal fade" id="receiveDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="background: #008B8B; color: white" class="modal-header">
        Add Received Document
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('/add_receiveDocs') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
          <div class="col-md-10">
            <div class="form-group">
                <label for="doc_id">Document Type</label>
                <select name="doc_id" id="doc_id" class="form-control" required>
                  @foreach($docdesc as $item)
                    <option value="{{ $item->id }}">{{ $item->doc_desc }}</option>
                  @endforeach
                </select>
              </div>
          </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="tran_id">Transaction ID</label>
              <input type="text" value="" name="tran_id" class="form-control" id="tran_id" placeholder="Transaction id" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="file">File</label>
                <input type="file" name="file" class="form-control" id="file" placeholder="Transaction id">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-10">
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
              <div class="col-md-6">
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
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tran_id">Transaction ID</label>
                  <input type="text" name="tran_id" class="" id="tran_id" placeholder="Transaction id">
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

<!--ReleaseDoc-->
<div class="modal fade" id="DocumentTemp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="background: #008B8B; color: white" class="modal-header">
        Add Document Template
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('/add_DocTemplate') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="doc_desc">Document description</label>
                  <input type="text" name="doc_desc" class="form-control" id="doc_desc" placeholder="Document Description">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="file">File</label>
                  <input type="file" name="file" class="" id="file" placeholder="Transaction id">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10">
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
<footer class="c-footer">
  <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
  <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 <script src="assets/js/main.js"></script>
@endsection