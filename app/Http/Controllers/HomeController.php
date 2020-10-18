<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Auth;

use App\Transaction;

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


    public function statement()
    {

        // $all_transactions =  DB::table('transactions')->where('user_id', Auth::user()->id)->paginate(10);

        $trans = Transaction::all();

      
        return view('statement',[
            'transactions' => $trans
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $trans = new Transaction;

        $trans = DB::table('transactions')->where('user_id', Auth::user()->id)->get();

        $total_balance = $trans->sum('amount');

       

        return view('/home',[
            'balance' => $total_balance
        ]);
    }
}
