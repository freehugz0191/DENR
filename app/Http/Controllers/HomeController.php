<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TranHistory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $approve = Transaction::all()->where('status_ID', 2);
        $reject = Transaction::all()->where('status_ID', 3);
        $pending = Transaction::all()->where('status_ID', 1);
        $history = TranHistory::join('users', 'tran_histories.user_id', '=', 'users.id')
                                ->select('tran_histories.*', 'users.name')
                                ->orderBy('id', 'desc')
                                ->get();
        return view('home')
                ->with('approve', $approve)
                ->with('reject', $reject)
                ->with('pending', $pending)
                ->with('history', $history);
    }
    
    public function handleAdmin()
    {
        $reject = Transaction::all()->where('status_ID', 3);
        $approve = Transaction::all()->where('status_ID', 2);
        $pending = Transaction::all()->where('status_ID', 1);
        $history = TranHistory::join('users', 'tran_histories.user_id', '=', 'users.id')
                                ->select('tran_histories.*', 'users.name')
                                ->orderBy('tran_histories.id', 'desc')
                                ->paginate(5);
        return view('handleAdmin')
                ->with('approve', $approve)
                ->with('reject', $reject)
                ->with('pending', $pending)
                ->with('history', $history);
    }  
}
