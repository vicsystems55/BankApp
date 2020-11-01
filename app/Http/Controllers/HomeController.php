<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Auth;

use App\Transaction;

use App\DirectBonus;

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
        $user_id = Auth::user()->id;

        // $all_transactions =  DB::table('transactions')->where('user_id', Auth::user()->id)->paginate(10);

        $transactions = \App\Transaction::where('user_id', $user_id )->get();

      
        return view('statement', compact('transactions'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $trans = new Transaction;

        $user_data = DB::table('users')->get();

        $trans = DB::table('transactions')->where('user_id', Auth::user()->id)->get();

        $total_balance = $trans->sum('amount');

        $db_data = new DirectBonus;
        
        $db_data = DB::table('direct_bonuses')->where('referral', Auth::user()->account_no)->get();

        $db_points = $db_data->sum('points');

        $upliner = DB::table('direct_bonuses')->where('referree', Auth::user()->account_no)->first();
    
      
       

        return view('/home',[
            'balance' => $total_balance,
            'db_data' => $db_data,
            'upliner' => $upliner,
            'user_data' => $user_data,
            'db_points' => $db_points
        ]);
    }
}
