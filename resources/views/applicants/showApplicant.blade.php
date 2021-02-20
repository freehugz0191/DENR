@extends('layouts.app')
<style>
    .modal-content{
    position: relative;
    display: flex;
    flex-direction: column;
    margin-top: 30%;
}
</style>
@section('content')
    <div class="container">
        
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="margin-top: -20px" class="card">
                    <div class="card-header">Manage Applicants</div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="font-weight: 700" for="ID">Applicant ID: </label>
                                </div>
                                <div class="col-sm-3">
                                    <label for="ID">{{$applicant->id}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="font-weight: 700" for="ID">Applicant name: </label>
                                </div>
                                <div class="col-sm-6">
                                    <label for="ID">{{$applicant->lname}}, {{$applicant->fname}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="font-weight: 700" for="ID">Contact number: </label>
                                </div>
                                <div class="col-sm-6">
                                    <label for="ID">{{$applicant->contact}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="font-weight: 700" for="ID">Email: </label>
                                </div>
                                <div class="col-sm-6">
                                    <label for="ID">{{$applicant->email}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="font-weight: 700" for="ID">Address: </label>
                                </div>
                                <div class="col-sm-6">
                                    <label for="ID">{{$applicant->address}}</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="font-weight: 700" for="ID">Created At: </label>
                                </div>
                                <div class="col-sm-6">
                                    <label for="ID">{{$applicant->created_at}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="font-weight: 700" for="ID">Updated at: </label>
                                </div>
                                <div class="col-sm-6">
                                    <label for="ID">{{$applicant->updated_at}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <a style="color: #008B8B" data-toggle="modal" data-target="#editApplicant" type="button" title="edit" rel="tooltip" > 
                                        Edit
                                    </a>&nbsp;
                                    {{-- <a style="color: #008B8B" data-toggle="modal" data-target="#deleteApplicant" type="button" title="delete" rel="tooltip" > 
                                        Delete
                                    </a> --}}
                                    {{-- <div class="modal fade" id="deleteApplicant" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div style="background: red; color: white" class="modal-header"></div>
                                                    <div class="modal-body">
                                                        <p style="text-align: center">Are you sure you want to delete applicant?</p> 
                                                        <form action="{{ url('deleteApplicant/'.$applicant->ID) }}" method="POST">
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
                                    </div> --}}
                                    <div class="modal fade" id="editApplicant" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div style="background:#008B8B; color: white" class="modal-header"></div>
                                                    <div class="modal-body">
                                                        <p style="text-align: center">Proceed to edit applicant?</p> 
                                                        <form action="{{ url('edit_applicants/'.$applicant->id) }}" >
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
            </div>
        </div>
    </div>
    
    
    <footer class="c-footer">
        <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
        <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
    </footer>
@endsection
