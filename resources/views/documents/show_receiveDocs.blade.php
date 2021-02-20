@extends('layouts.app')
<link rel="stylesheet" href="/css/css_home.css">
<link rel="stylesheet" href="/css/css_recdocs.css">

@section('content')
<h3 style="margin-left: 20px; margin-bottom: 40px">Document {{$document->id}} Details</h3>
<div class="row">
  <div class="col-3">
    <a style="margin-bottom: 10px; margin-left:15px" href="{{ url('/receiveDocs')}}" class="btn btn-outline-success"><i class="fa fa-arrow-circle-left"></i> Back</a>
  </div>
  <div class=" col-9 pull-right" style="margin-bottom: 5px; align-items: center; ">
    <form action="{{ url('update_dept/'.$document->id) }}">
          @csrf
          @method('PATCH')
          <select name="dept_id" id="" class="form-select  pull-right" style="width: 400px; margin-left: 5px;margin-right: 18px">
            <option value="" disabled selected>Send to other department</option>
            @foreach ($department as $item)
            <option value="{{ $item->id }}">{{ $item->dept_desc }}</option>
            @endforeach
          </select>
          <button style="margin-top: 2px" type="submit" class="btn btn-outline-success pull-right">Send</button>
    </form>
  </div>
</div>
  <div class="container justify-content-center">
    <div class="row">
      <div class="col-md-5">
        
        <div class="card" style="height: 500px; width: 400px">
  
          <div class="card-header" style="font-weight: 700; text-align: center">File</div>
          <div class="card-body" id="wrap"><p><iframe id="frame" src="{{url('storage/'.$document->file)}}" frameborder="0" style="width: 100%; height: 60vh; object-fit:cover"></iframe></p></div>
        
        </div>
      </div>
      <div class="col-md-7">
      <div class="card" style="height: 500px">
        <div style="font-weight: 700" class="card-header">Document details</div>
        <div class="card-body">
            <div class="form-group">
                
                  <div class="row">
                    <div class="col-md-3">
                        <label style="font-weight: 700" for="ID">Document ID: </label>
                    </div>
                    <div class="col-md-7">
                        <label for="ID">{{$document->id}}</label>
                    </div>
                  </div>
                
            </div>
            <div class="form-group">
                
                <div class="row">
                  <div class="col-md-3">
                        <label style="font-weight: 700" for="ID">Document type: </label>
                  </div>
                  <div class="col-md-7">
                        <label for="ID">{{$document->doc_desc}}</label>
                  </div>
                </div>
               
            </div>
            <div class="form-group">
                
                <div class="row">
                  <div class="col-md-3">
                        <label style="font-weight: 700" for="ID">Transaction ID: </label>
                  </div>
                  <div class="col-md-7">
                        <label for="ID"></label>
                    <a href="{{ url('show_subDocs/'.$document->tran_id) }}">{{$document->tran_id}}</a>
                  </div>
                </div>
               
            </div>
            <div class="form-group">
                
                <div class="row">
                  <div class="col-md-3">
                        <label style="font-weight: 700" for="ID">Status: </label>
                  </div>
                  <div class="col-md-7">
                        <label for="ID">{{$document->status_desc}}</label>
                  </div>
                </div>
               
            </div>
            <div class="form-group">
               
                <div class="row">
                  <div class="col-md-3">
                        <label style="font-weight: 700" for="ID">Created by: </label>
                  </div>
                  <div class="col-md-7">
                        <label for="ID">{{$document->name}}</label>
                  </div>
                </div>
                
            </div>
            
            <div class="form-group">
                
                <div class="row">
                  <div class="col-md-3">
                        <label style="font-weight: 700" for="ID">Remarks: </label>
                  </div>
                  <div class="col-md-7">
                        <label for="ID">{{$document->remarks}}</label>
                  </div>
                </div>
               
            </div>
            <div class="form-group">
               
                <div class="row">
                  <div class="col-md-3">
                        <label style="font-weight: 700" for="ID">Created at: </label>
                  </div>
                  <div class="col-md-7">
                        <label for="ID">{{$document->created_at->format('F j, Y g:i A')}}</label>
                  </div>
                </div>
                
            </div>
            <div class="form-group">
              
                <div class="row">
                  <div class="col-md-3">
                        <label style="font-weight: 700" for="ID">Last updated: </label>
                  </div>
                  <div class="col-md-7">
                        <label for="ID">{{$document->updated_at->format('F j, Y g:i A')}}</label>
                  </div>
                </div>
                
            </div>
            
            
        </div>
        </div>
      </div>
    </div>
    
  </div>
    

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
<div class="modal fade" id="receiveDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="background: #008B8B; color: white" class="modal-header">
        Add Document Type
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      
      <div class="modal-body">
        <form action="{{ url('/add_receiveDocs') }}" method="POST">
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
                <input type="text" name="tran_id" class="form-control" id="tran_id" placeholder="Transaction id">
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
@endsection