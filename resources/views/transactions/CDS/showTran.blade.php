@extends('layouts.app')
<link rel="stylesheet" href="css/css_home.css">
<style>
    .modal-content{
    position: relative;
    display: flex;
    flex-direction: column;
    margin-top: 30%;
}
 a{
     color: #008B8B;
 }
</style>
@section('content')
    <div style="margin-top: -20px" class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
            <div><a href="{{ url('/CDStransactions')}}"><- Back to Transactions list</a></div>
                <div class="card">
                    <div class="card-header">Manage Transactions</div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="pull-right" style="font-weight: 700" for="ID">Transaction ID: </label>
                                </div>
                                <div class="col-sm-3">
                                    <label for="ID">{{$transactionShow->id}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="pull-right" style="font-weight: 700" for="ID">Permit: </label>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ID">{{$transactionShow->tran_desc}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="pull-right" style="font-weight: 700" for="ID">Applicant: </label>
                                </div>
                                <div class="col-sm-6">
                                    <label for="ID">{{$transactionShow->lname}}, {{$transactionShow->fname}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="pull-right" style="font-weight: 700" for="ID">Applicant: </label>
                                </div>
                                <div class="col-sm-4">
                                    <label for="address">{{$transactionShow->address}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="pull-right" style="font-weight: 700" for="ID">Latitude: </label>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ID">{{$transactionShow->latitude}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="pull-right" style="font-weight: 700" for="ID">Longitude: </label>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ID">{{$transactionShow->longitude}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="pull-right" style="font-weight: 700" for="ID">Status: </label>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ID">{{$transactionShow->status_name}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="pull-right" style="font-weight: 700" for="ID">Remarks: </label>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ID">{{$transactionShow->remarks}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="pull-right" style="font-weight: 700" for="ID">Created At: </label>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ID">{{$transactionShow->created_at}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="pull-right" style="font-weight: 700" for="ID">Last Updated at: </label>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ID">{{$transactionShow->updated_at}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div style="margin-left: 50px" class="col-sm-4">
                                    <a style="color: #008B8B" data-toggle="modal" data-target="#editTran" type="button" title="edit" rel="tooltip" > 
                                        Edit
                                    </a>&nbsp;
                                    <a style="color: #008B8B" data-toggle="modal" data-target="#deleteTran" type="button" title="delete" rel="tooltip" > 
                                        Delete
                                    </a>
                                    <form action="{{ url('show_payment/'.$transactionShow->id) }}">
                                        @csrf
                                        <div style="margin-left: 45%">
                                        <button style="padding: 2px; "  class="btn btn-success" style=" float: right;" type="submit" style="margin-left: 5px" title="payment" rel="tooltip">
                                            Proceed to Payments
                                        </button>
                                        </div>
                                    </form>

                                    <div class="modal fade" id="deleteTran" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div style="background: red; color: white" class="modal-header"></div>
                                                    <div class="modal-body">
                                                        <p style="text-align: center">Are you sure you want to delete transaction?</p> 
                                                        <form action="{{ url('deleteTran/'.$transactionShow->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div style="margin-left: 45%">
                                                            <button style="padding: 2px; "  class="btn btn-danger" style="padding: 0%; float: right;" type="submit" style="margin-left: 5px" title="Delete" rel="tooltip">
                                                            Delete
                                                            </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="editTran" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div style="background:#008B8B; color: white" class="modal-header"></div>
                                                    <div class="modal-body">
                                                        <p style="text-align: center">Proceed to edit transaction?</p> 
                                                        <form action="{{ url('CDSedit_transactions/'.$transactionShow->id) }}" >
                                                            @csrf
                                                            <div style="margin-left: 45%">
                                                            <button style="padding: 4px; "  class="btn btn-success" style="padding: 0%; float: right;" type="submit" style="margin-left: 5px" title="Delete" rel="tooltip">
                                                            Edit
                                                            </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div style="font-weight: 500">Remarks History</div> 
                    </div>
                    <div class="card-body">
                        <div class="col-md-6">
                            @foreach ($history as $item)
                                <div>
                                    
                               - <strong>{{$item->name}}</strong> updated: <strong>{{$item->tran_remarks}}</strong> <strong>({{$item->created_at->format('j F, Y')}}).</strong>
                                   
                                </div> <br>
                            @endforeach
                            
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
