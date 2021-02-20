@extends('layouts.app')

@section('content')
<h3 style="margin-left: 20px; margin-bottom: 40px">Requested Document for Transaction {{$document->tran_id}}</h3>
@if(Auth::user()->is_admin==1)
  
      <a href="{{ url('accept_releaseDocs/'.$document->id) }}" style="margin-right: 15px" type="button" class="btn btn-outline-success float-right"><i class="fa fa-paper-plane" title="release" rel="tooltip"></i> Release Document</a>
  
@endif
<div class="row">
    <div class="col-3">
      <a style="margin-bottom: 10px; margin-left:15px" href="{{ url('/releaseDocs')}}" class="btn btn-outline-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
      
    </div>
</div>
<div class="container justify-content-center">
    <div class="row">
      <div class="col-md-5">
        <div class="card" style="height: 500px; width: 400px">
            <div class="card-header" style="font-weight: 700; text-align: center">File</div>
            <div class="card-body" id="wrap"><p><iframe id="frame" src="{{url('storage/'.$document->file)}}" frameborder="0" style="width: 100%; height: 30vw; object-fit:cover"></iframe></p></div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="card" style="height: 500px">
          <div style="font-weight: 700" class="card-header">Requested Cert/Permit details</div>
          <div class="card-body">
              <div class="form-group">
                  
                    <div class="row">
                      <div class="col-md-3">
                          <label style="font-weight: 700" for="ID">Request ID: </label>
                      </div>
                      <div class="col-md-7">
                          <label for="ID">{{$document->id}}</label>
                      </div>
                    </div>
                  
              </div>
              <div class="form-group">
                  
                  <div class="row">
                    <div class="col-md-3">
                          <label style="font-weight: 700" for="ID">Permit/Cert Name: </label>
                    </div>
                    <div class="col-md-7">
                          <label for="ID">{{$document->doc_desc}}</label>
                    </div>
                  </div>
                 
              </div>
              <div class="form-group">
                  
                <div class="row">
                  <div class="col-md-3">
                        <label style="font-weight: 700" for="ID">Transaction: </label>
                  </div>
                  <div class="col-md-7">
                        <label for="ID">{{$document->tran_id}}</label>
                  </div>
                </div>
               
            </div>
            <div class="form-group">
                  
                <div class="row">
                  <div class="col-md-3">
                        <label style="font-weight: 700" for="ID">Requested by: </label>
                  </div>
                  <div class="col-md-7">
                        <label for="ID">{{$document->name}}</label>
                  </div>
                </div>
               
            </div>
            <div class="form-group">
                  
                <div class="row">
                  <div class="col-md-3">
                        <label style="font-weight: 700" for="ID">Status: </label>
                  </div>
                  <div class="col-md-7">
                        <label for="ID">{{$document->status_name}}</label>
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
<footer class="c-footer">
    <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
    <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
</footer>

@endsection