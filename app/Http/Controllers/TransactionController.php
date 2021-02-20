<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Permit;
use App\Models\Status;
use App\Models\Applicant;
use DB;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::orderBy('id', 'DESC')->get();
        $permit = Permit::all();
        $status = Status::all();
        $applicant = Applicant::all();

        
        return view('permit/transaction')
        ->with('transaction', $transaction)
        ->with('permit', $permit)
        ->with('status', $status)
        ->with('applicant', $applicant);
    }

    public function approveTran($id) 
    {
        Transaction::where('id', '=', $id)->update(array(
            'status_ID' => 2
            ));
            
            return redirect()->back();
    }

    public function rejectTran(Request $request, $id) 
    {
        Transaction::where('id', '=', $id)->update(array(
            'status_ID' => 3,
            'remarks' => $request->remarks
            ));
            
            return redirect()->back();
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
        $transaction = new Transaction;

        $transaction->permit_ID = $request->permit_ID;
        $transaction->applicant_ID = $request->applicant_ID;
        $transaction->longitude = $request->longitude;
        $transaction->latitude = $request->latitude;
        $transaction->status_ID = $request->status_ID;
        $transaction->remarks = $request->remarks;
        $transaction->save();
    
        return redirect('permit/transaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::all();
        $permit = Permit::all();
        $status = Status::all();
        $data = Transaction::findOrFail($id);

        $transactionShow = DB::table('transactions')
                ->join('permits', 'permits.ID', '=', 'transactions.permit_ID')
                ->join('applicants', 'applicants.id', '=', 'transactions.applicant_ID')
                ->join('status', 'status.id', '=', 'transactions.status_ID')
                ->select('transactions.*', 'permits.permit_name', 'applicants.fname', 'applicants.lname', 'status.status_name')
                ->where('transactions.id', '=', $id)
                ->first();

        $countPending = $transaction->where('status_ID','=', 1);
        $countApproved = $transaction->where('status_ID','=', 2);
        $countRejected = $transaction->where('status_ID','=', 3);

        return view('permit/showTran')
        ->with('transaction' ,$transaction)
        ->with('transactionShow' ,$transactionShow)
        ->with('countPending', $countPending)
        ->with('countApproved', $countApproved)
        ->with('countRejected', $countRejected)
        ->with('permit' ,$permit)
        ->with('status' ,$status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transactionCount = Transaction::all();
        $permit = Permit::all();
        $status = Status::all();
        $applicant = Applicant::all();

        $countPending = $transactionCount->where('status_ID','=', 1);
        $countApproved = $transactionCount->where('status_ID','=', 2);
        $countRejected = $transactionCount->where('status_ID','=', 3);

        
        return view('permit/editTran')
        ->with('transaction', $transaction)
        ->with('permit', $permit)
        ->with('status', $status)
        ->with('countPending', $countPending)
        ->with('countApproved', $countApproved)
        ->with('transactionCount', $transactionCount)
        ->with('applicant', $applicant)
        ->with('countRejected', $countRejected);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Transaction::where('id', '=', $id)->update(array(
            'permit_ID' => $request->input('permit_ID'),
            'applicant_ID' => $request->input('applicant_ID'),
            'longitude' => $request->input('longitude'),
            'latitude' => $request->input('latitude'),
            'status_ID' => $request->input('status_ID'),
            'remarks' => $request->input('remarks')
            ));
            
            return redirect('permit/transaction')->with('status','Transaction Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaction::where('id', '=', $id)->delete();
  
        return  redirect('permit/transaction')->with('status', 'Transaction Deleted');
    
    }
}
