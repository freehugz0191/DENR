<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use DB;

class UsersController extends Controller
{
    public function index()
    {
        $user = User::paginate(10);

        return view('transactions.usersTable', compact('user'));
    }

    public function edit($id)
    {
      
        $user = User::findOrFail($id);
        $department = Department::all();

        return view('transactions/editUsers')
        ->with('user', $user)
        ->with('department', $department);
    }

    public function update(Request $request, $id)
    {
        User::where('id', '=', $id)->update(array(
            'name' => $request->input('name'),
            'dept_id' => $request->input('dept_id'),
            'email' => $request->input('email'),
            ));
            
            return redirect('/users_table')->with('status','User Updated');
        
    }
}
