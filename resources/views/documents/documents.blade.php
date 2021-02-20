@extends('layouts.app')

@section('content')
@if(count($document) > 0)
  <h3 style="margin-left: 20px">Submitted Documents Compilation</h3>
@else
  <h3 style="margin-left: 20px">There are no submissions yet for Transaction # {{$doctran->id}}.</h3>
@endif

<div class="container">
    <div style="padding: 10px" class="card">
    <div class="row">
        <div class="col-6">
          <button style="font-size: 15px; margin-bottom:10px" class="btn btn-primary pull-left"  data-toggle="modal" data-target="#receiveDocument"><i  class="fa fa-plus"></i>&nbsp; Submit Document</button>
          <p class="pull-right">Transaction Status: &nbsp; <strong style="font-size: 20px">{{$doctran->status_name}}</strong> </p>
        </div>
        <div class="col-md-6">
          @if (auth()->user()->is_admin==1)
            <button style="font-size: 15px; margin-bottom:10px" data-toggle="modal" data-target="#rejectTran" class="btn btn-danger pull-right"><i  class="fa fa-times-circle-o"></i>&nbsp; Reject</button>
            <form action="{{ url('approveTran/'.$doctran->id) }}" method="POST">
              @csrf
              @method('PATCH')
              <button type="submit" onclick="return confirm('By clicking OK, you have checked all the documents are complete and verified. Are you sure you want to approve this transaction?')" style="font-size: 15px; margin-bottom:10px; margin-right: 5px" class="btn btn-success pull-right"><i  class="fa fa-check-square-o"></i>&nbsp; Approve</button>
            </form>
          @endif
          
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div style="font-weight: 500" class="card-header">
                    Submitted Documents
                </div>
                
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr style="font-size: 12px">
                            <th style="width: 50px" scope="col">Document ID</th>
                            <th style="width: 150px" scope="col">Document type</th>
                            <th style="width: 100px" scope="col">Transaction ID</th>
                            <th style="width: 150px" scope="col">Status</th>
                            <th style="width: 100px" scope="col">Remarks</th>
                            <th style="width: 50px" scope="col">Actions</th>
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
                                    <td><a href="{{ url('show_receiveDocs/'.$item->id) }}" type="button" title="show" rel="tooltip" > 
                                        <i class="fa fa-eye"></i>
                                        </a>&nbsp;</td>
                                </tr>
                            @endforeach
                    
                        </tbody>
                    </table>
    </div>
</div>
</div>
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
                <input type="text" value="{{$doctran->id}}" name="tran_id" class="form-control" id="tran_id" placeholder="Transaction id" readonly>
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

  {{-- reject Tran --}}
  <div class="modal fade" id="rejectTran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div style="background: #a84247; color: white" class="modal-header">
          Reject Transaction
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <i class="fa fa-question-circle-o"></i> Please leave in the remarks the reasons for rejecting the transaction.
          
         <form action="{{ url('rejectTran/'.$doctran->id) }}" method="POST" >
            @csrf
           @method('PATCH')
            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <br>
                  <label for="remarks"><strong>Remarks</strong> </label>
                  <textarea type="text" name="remarks" class="form-control" id="remarks" rows="3" required></textarea>
                </div>
              </div>
            </div>
            <div style="align-items: baseline" class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-danger"><i class="fa fa-times-circle-o"></i> Confirm Reject</button>
            </div>    
          </form>
        </div>
      </div>
    </div>
  </div>
 
@endsection