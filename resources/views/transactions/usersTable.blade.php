
@extends('layouts.app')
<style>
     #mapid
  { 
      height: 300px;
      width: 450px;
      margin-left: -12px;

  }

    
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div style="font-weight: 700" class="card-header">Manage Users</div>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr style="font-size: 12px">
                            <th scope="col">Employee ID</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Email</th>
                            <th scope="col">Username</th>
                            <th scope="col">Date Registered</th>
                            
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                                <tr style="font-size: 12px">
                                    
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->dept_id }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        
                                        <a href="{{ url('edit_users/'.$item->id) }}" type="button" title="edit" rel="tooltip" > 
                                            <i class="fa fa-edit"></i>
                                        </a>&nbsp;
                                        <a style="color: #008B8B" data-toggle="modal" data-target="#deleteTran" type="button" title="delete" rel="tooltip" > 
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        
                                        <div class="modal fade" id="deleteTran" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div style="background: red; color: white" class="modal-header"></div>
                                                        <div class="modal-body">
                                                            <p style="text-align: center">Are you sure you want to delete user?</p> 
                                                            <form action="{{ url('deleteTran/'.$item->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div style="margin-left: 45%">
                                                                <button style="padding: 2px;"  class="btn btn-danger" style="padding: 0%; float: right;" type="submit" style="margin-left: 5px" title="Delete" rel="tooltip">
                                                                Delete
                                                                </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
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