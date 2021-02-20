<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DynamicPayment;
use Validator;
use DB;

class DynamicPayController extends Controller
{
    public function index(){
        return view('transactions/payment');
    }

    public function store_dynamicPay(Request $request){
        if($request->ajax())
        {
            $rules = array(
                'description.*' => 'required',
                'amount.*' => 'required'
            );
            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }

            $description = $request->description;
            $amount = $request->amount;
            $tran_id = $request->tran_id;
            for($count = 0; $count < count($description); $count++)
            {
                $data = array(
                    'tran_id' => $tran_id[$count],
                    'payment_desc' => $description[$count],
                    'amount' => $amount[$count]

                );
                $insert_data[] = $data;
            }
            DynamicPayment::insert($insert_data);
            return response()->json([
                'success'   =>  'Data added successfully.'
            ]);
        }
    }

}
