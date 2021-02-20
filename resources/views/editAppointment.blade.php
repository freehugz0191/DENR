
@extends('layouts.app')
<link rel="stylesheet" href="/css/css_home.css">
@section('content')
<div class="container">
    <div class="col-md-14">
        <div class="card">
            <div class="card-header" style="font-weight: 700">Manage Appointment</div>
            <div class="card-body">

                <form action="{{ url('update_appointments/'.$appointment->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id">Appointment ID</label>
                                <input disabled type="text" name="id" class="form-control" id="id" placeholder="" value="{{ $appointment->id }}" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="appointment_date">Appointment Date</label>
                                <input type="date" name="appointment_date" class="form-control" id="appointment_date" placeholder="" value="{{ $appointment->appointment_date }}" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dept_id">Applicant</label>
                                <select name="applicant_id" id="applicant_id" class="form-control" required>
                                    @foreach($applicant as $item)
                                    <option value="{{ $item->id }}" {{($item->id==$appointment->applicant_id) ? 'selected' : ''}}>{{ $item->lname }}, {{ $item->fname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                            <textarea type="text" name="description" class="form-control" id="description" rows="3" required>{{ $appointment->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div style="align-items: baseline" class="modal-footer">
                        <button type="submit" class="btn btn-round btn-primary btn-success pull-right">Update</button>
                        <a href="{{ url('transactions/usersTable') }}" type="button" class="btn btn-round btn-secondary pull-right">Back</a>
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
