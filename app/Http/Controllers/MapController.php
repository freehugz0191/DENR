<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use DB;

class MapController extends Controller
{
    public function index() {
        $transaction = Transaction::all();

        $transactionShow = DB::table('transactions')
                
                ->join('status', 'status.id', '=', 'transactions.status_ID')
                ->join('applicants', 'applicants.id', '=', 'transactions.applicant_id')
                ->select('transactions.id','transactions.latitude','transactions.longitude','applicants.fname','applicants.lname','status.status_name')
                ->get();


        return view('transactions/map')
            ->with('transaction', $transaction)
            ->with('transactionShow', $transactionShow);
    }
}
