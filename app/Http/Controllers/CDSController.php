<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Status;
use App\Models\Applicant;
use App\Models\Trandesc;
use App\Models\TranHistory;
use DB;
use Auth;

class CDSController extends Controller
{
    public function index()
    {
        $transaction = Transaction::orderBy('transactions.id', 'DESC')
                    ->join('trandesc', 'trandesc.id','=', 'transactions.procedure_id')
                    ->join('procedure_sections', 'procedure_sections.id','=', 'trandesc.section_id')
                    ->join('applicants', 'applicants.id','=', 'transactions.applicant_id')
                    ->join('status', 'status.id','=', 'transactions.status_ID')
                    ->select('transactions.*', 'applicants.fname', 'applicants.lname', 'status.status_name')
                    ->where('trandesc.section_id', '=', 1)
                    ->paginate(10);
       
        $status = Status::all();
        $applicant = Applicant::all();
        $trandesc = Trandesc::where('section_id', '=', 1)->get();

        
        return view('transactions/CDS/transaction')
        ->with('transaction', $transaction)
        ->with('status', $status)
        ->with('trandesc', $trandesc)
        ->with('applicant', $applicant);
    }

    public function store(Request $request)
    {
        $transaction = new Transaction;

        $transaction->procedure_id = $request->procedure_id;
        $transaction->applicant_id = $request->applicant_id;
        $transaction->address = $request->address;
        $transaction->longitude = $request->longitude;
        $transaction->latitude = $request->latitude;
        $transaction->status_ID = 1;
        $transaction->remarks = $request->remarks;
        $transaction->save();

        $tran_history = new TranHistory;
        $tran_history->user_id = Auth::user()->id;
        $tran_history->tran_id = $transaction->id;
        $tran_history->tran_remarks = $transaction->remarks;
        $tran_history->save();
    
        return redirect('/CDStransactions');
    }

    public function show($id)
    {
        $transaction = Transaction::all();
        $trandesc = Trandesc::all();
        $status = Status::all();
        $data = Transaction::findOrFail($id);

        $transactionShow = DB::table('transactions')
                ->join('trandesc', 'trandesc.ID', '=', 'transactions.procedure_id')
                ->join('applicants', 'applicants.id', '=', 'transactions.applicant_id')
                ->join('status', 'status.id', '=', 'transactions.status_ID')
                ->select('transactions.*', 'trandesc.tran_desc', 'applicants.fname', 'applicants.lname', 'status.status_name')
                ->where('transactions.id', '=', $id)
                ->first();

        $history = TranHistory::orderBy('tran_histories.id', 'DESC')
                ->join('transactions', 'transactions.id', '=', 'tran_histories.tran_id')
                ->join('users', 'users.id', '=', 'tran_histories.user_id')
                ->select('tran_histories.*', 'users.name as name', 'transactions.remarks')
                ->where('tran_histories.tran_id', '=', $id)
                ->get();

        return view('transactions/CDS/showTran')
        ->with('transaction' ,$transaction)
        ->with('transactionShow' ,$transactionShow)
        ->with('trandesc' ,$trandesc)
        ->with('history' ,$history)
        ->with('status' ,$status);
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transactionCount = Transaction::all();
        $status = Status::all();
        $applicant = Applicant::all();
        $trandesc = Trandesc::all();


        
        return view('transactions/CDS/editTran')
        ->with('transaction', $transaction)
        ->with('status', $status)
        ->with('trandesc', $trandesc)
        ->with('applicant', $applicant);

    }

    public function update(Request $request, $id)
    {

        Transaction::where('id', '=', $id)->update(array(
            'procedure_id' => $request->input('procedure_id'),
            'applicant_id' => $request->input('applicant_id'),
            'address' => $request->input('address'),
            'longitude' => $request->input('longitude'),
            'latitude' => $request->input('latitude'),
            'status_ID' => 1,
            'remarks' => $request->input('remarks')
            ));

        $tran_history = new TranHistory;
        $tran_history->user_id = Auth::user()->id;
        $tran_history->tran_id = $id;
        $tran_history->tran_remarks = $request->remarks;
        $tran_history->save();
            
            return redirect('/CDStransactions')->with('status','Transaction Updated');
        
    }

    public function destroy($id)
    {
        Transaction::where('id', '=', $id)->delete();
  
        return  redirect('/CDStransactions')->with('status', 'Transaction Deleted');
    
    }
}

