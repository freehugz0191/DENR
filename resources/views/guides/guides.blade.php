@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

@section('content')
<div class="row" style="align-items: center">
    <div class="col-9">
      <h6>Note: This is the page where you can add, edit, and see the procedures or guides in every transaction description.</h6>
    </div>
    <div class="col-3">
      <a href="" class="btn btn-outline-success" style="padding: 10px" data-toggle="modal" data-target="#addGuide"><i class="fa fa-book"></i> <span>Add Guide</span></a>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-11 container2 border text-center mt-4 w-50">
    <h3 class="m-4 text-primary">Guides</h3>
    </div>
  </div>

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
        </div>
            <table id="req_table" class="table table-striped">
                <thead class="thead-light">
                    <tr style="font-size: 12px">
                    <th>Description ID</th>
                    <th>Transaction Description</th>
                    <th>Section</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  
                    @foreach ($trandesc as $item)
                    <tr style="font-size: 12px">
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->tran_desc }}</td>
                      <td>{{ $item->section_desc }}</td>
                      <td>
                              <a href="{{ url('show_guide/'.$item->id)}}" class="btn-btn-outline-success">Show Guide</a>
                            
                            
                         
                      
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
 
  
  <footer class="c-footer">
    <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
    <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
</footer>
@endsection