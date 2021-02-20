@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form action="{{ url('update_receiveDocs/'.$document->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
            <div class="col-md-10">
            <div class="form-group">
                <label for="doc_id">Document Type</label>
                <select name="doc_id" id="doc_id" class="form-control" required>
                    @foreach($docdesc as $item)
                    <option value="{{ $item->id }}" {{($item->id==$document->doc_id) ? 'selected' : ''}}>{{ $item->doc_desc }}</option>
                    @endforeach
                </select>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="tran_id">Transaction ID</label>
                <input type="text" value="{{ $document->tran_id }}" name="tran_id" class="form-control" id="tran_id" placeholder="Transaction id">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="file">File</label>
                <input type="file" name="file" class="" id="file" >
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea type="text" value="" name="remarks" class="form-control" id="remarks" rows="3" required>{{ $document->remarks }}</textarea>
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
@endsection