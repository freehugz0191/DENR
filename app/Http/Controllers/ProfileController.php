<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    public function index(){

        return view('profile/profile');
    }

    public function update_picture(Request $request){
       
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = Auth::user();
        $file = $request->file('file');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $request->file->move('storage/', $fileName);

        $user->file = $fileName;
        $user->save();


        return redirect()->back();
    }
}
