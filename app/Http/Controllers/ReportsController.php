<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use DB;

class ReportsController extends Controller
{
    public function index()
    {
        $transactions = Transaction::select(DB::raw("COUNT(*) as count"))
                        ->whereYear('created_at', 2021)
                        ->groupBy(DB::raw("Month(created_at)"))
                        ->pluck('count');

        $months = Transaction::select(DB::raw("Month(created_at) as month"))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("Month(created_at)"))
                        ->pluck('month');

        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month)
        {
            $datas[$month] = $transactions[$index];
        }

        return view('reports', compact('datas'));
    }
}
