
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-14">
        <div class="card">
            <div class="card-header">Manage Applicants</div>
            <div class="card-body">

                <form action="{{ url('update_users/'.$user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="" value="{{ $user->name }}" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dept_id">Department</label>
                                <select name="dept_id" id="dept_id" class="form-control" required>
                                    @foreach($department as $item)
                                    <option value="{{ $item->id }}" {{($item->id==$user->dept_id) ? 'selected' : ''}}>{{ $item->dept_desc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="" value="{{ $user->email }}" >
                            </div>
                        </div>
                    </div>

                    <div style="align-items: baseline" class="modal-footer">
                        <button type="submit" class="btn btn-round btn-primary btn-success pull-right">Update</button>
                        <a href="{{ url('/users_table') }}" type="button" class="btn btn-round btn-secondary pull-right">Back</a>
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
