<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Transaction;
use DB;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicant = Applicant::paginate(10);
        
        return view('applicants/applicant')
            ->with('applicant', $applicant);
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $applicant = new Applicant;

        $applicant->fname = $request->fname;
        $applicant->lname = $request->lname;
        $applicant->contact = $request->contact;
        $applicant->email = $request->email;
        $applicant->password = $request->password;
        $applicant->gender = $request->gender;
        $applicant->date_birth = $request->date_birth;
        $applicant->address = $request->address;
        $applicant->save();
        return redirect('/applicants')->with('status','Applicant added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $applicant = Applicant::findOrFail($id);

        return view('applicants/showApplicant')
        ->with('applicant', $applicant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $applicant = Applicant::findOrFail($id);
        
        
        return view('applicants/editApplicant')
        ->with('applicant', $applicant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Applicant::where('id', '=', $id)->update(array(
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'contact' => $request->input('contact'),
            'email' => $request->input('email'),
            'address' => $request->input('address')
            ));
            
            return redirect('/applicants')->with('status','Applicant Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Applicant::where('id', '=', $id)->delete();
  
        return  redirect('/applicant')->with('status', 'Applicant Deleted');
    
    }
}
