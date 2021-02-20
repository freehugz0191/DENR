<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http\Models\PermitFile;
use Http\Models\Transaction;
use DB;

class PermitDocsController extends Controller
{
    public function index()
    {
        return view('permit/submitDocs');
    }

    

    public function show(Request $request)
    {
        
        $data = $request->get('tran_id');
        $transaction = DB::table('transactions')
                ->join('permits', 'permits.ID', '=', 'transactions.permit_ID')
                ->join('applicants', 'applicants.ID', '=', 'transactions.applicant_ID')
                ->select('transactions.id', 'permits.permit_name', 'applicants.fname', 'applicants.lname')
                ->where('transactions.id', $data)
                ->paginate(5);
        return view('permit/submitDocs', compact('transaction'));
    }
    
    public function showDoc($id) 
    {
        $transactionShow = DB::table('transactions')
                ->join('permits', 'permits.ID', '=', 'transactions.permit_ID')
                ->join('applicants', 'applicants.id', '=', 'transactions.applicant_ID')
                ->join('status', 'status.id', '=', 'transactions.status_ID')
                ->select('transactions.*', 'permits.permit_name', 'applicants.fname', 'applicants.lname', 'status.status_name')
                ->where('transactions.id', '=', $id)
                ->first();

                return view('permit/submitDocs', compact('transactionShow'));
    }
}
