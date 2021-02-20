<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DynamicPayment;
use DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    
    public function index()
    {
        
        return view('transactions/payment');

    }

    public function show(Request $request, $id)
    {
        
        $transaction = DB::table('transactions')
                ->join('trandesc', 'trandesc.ID', '=', 'transactions.procedure_id')
                ->join('applicants', 'applicants.id', '=', 'transactions.applicant_id')
                ->select('transactions.id', 'trandesc.tran_desc', 'applicants.fname', 'applicants.lname')
                ->where('transactions.id', $id)
                ->first();
        
        $payment = DynamicPayment::where('tran_id', $id)->get();

        $total = DynamicPayment::where('tran_id', $id)->sum('amount');

        return view('transactions/payment', compact('transaction'))
                    ->with('total', $total)
                    ->with('payment', $payment);
    }

    public function printPay($id)
    {

        $transaction = DB::table('transactions')
                ->join('trandesc', 'trandesc.ID', '=', 'transactions.procedure_id')
                ->join('applicants', 'applicants.id', '=', 'transactions.applicant_id')
                ->select('transactions.id', 'trandesc.tran_desc', 'applicants.fname', 'applicants.lname')
                ->where('transactions.id', $id)
                ->first();

        $payment = DynamicPayment::where('tran_id', $id)->get();
        $total = DynamicPayment::where('tran_id', $id)->sum('amount');
        $date = Carbon::now();

        return view('transactions.print', compact('transaction'))
                        ->with('payment', $payment)
                        ->with('total', $total)
                        ->with('date', $date);
    }
}
