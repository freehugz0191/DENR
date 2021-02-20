@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-14">
        <div class="card">
            <div class="card-header">Manage Applicants</div>
            <div class="card-body">
                
                <form action="{{ url('update_applicants/'.$applicant->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fname">Firstname</label>
                                <input type="text" name="fname" class="form-control" id="fname" placeholder="" value="{{ $applicant->fname }}" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lname">Firstname</label>
                                <input type="text" name="lname" class="form-control" id="lname" placeholder="" value="{{ $applicant->lname }}" >
                            </div>
                        </div>
                    </div>
                             
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" name="contact" class="form-control" id="contact" placeholder="" value="{{ $applicant->contact }}" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="" value="{{ $applicant->email }}" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address" rows="3" required value="{{ $applicant->address }}">
                            </div>
                        </div>
                    </div>
                    <div style="align-items: baseline" class="modal-footer">
                        <button type="submit" class="btn btn-round btn-primary btn-success pull-right">Update</button>
                        <a href="{{ url('/applicants') }}" type="button" class="btn btn-round btn-secondary pull-right">Back</a>
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