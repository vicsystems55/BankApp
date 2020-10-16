<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaction;

use App\User;

use Auth;
Use DB;

class TransactionController extends Controller
{
    public function enter_transaction()
    {
        # code...
        return view('dhome');
    } 
    
    public function post_transaction(Request $request)
    {

        $transaction = new Transaction;

        $user = new User;

        $transaction->type = $request->input('type');
        $transaction->amount = $request->input('amount');
        $transaction->user_id = Auth::user()->id;
      //  $transaction->save();
        // to get one coulumn
        $message = 'my message';

     

     //   $userBalance  = DB::table('users')->where('user_id', Auth::user()->id)->get();

                if ($request->input('type') == 'credit') {
                    # code...
                    $userBalance  = DB::table('users')->where('id', Auth::user()->id)->first();

                    $customerBalance = $userBalance->balance;

                    $newbalance = $customerBalance + $request->input('amount');
                    $transaction->balance = $newbalance;
                    $transaction->save();

                    DB::table('users')->where('id', Auth::user()->id)->update(["balance" => $newbalance]);
                   // dd($customerBalance);
                   $message = "you have been credited amount ".$request->input('amount');
                }
                else {



                    $userBalance  = DB::table('users')->where('id', Auth::user()->id)->first();

                    $customerBalance = $userBalance->balance;

                    if($request->input('amount') > $customerBalance) {

                     //
                     $message = "Insuffecient fund";
                    }

                    else {

                    $newbalance = $customerBalance - $request->input('amount');
                    $transaction->balance = $newbalance;
                    $transaction->save();

                    DB::table('users')->where('id', Auth::user()->id)->update(["balance" => $newbalance]);
                    $message = "you have been debited amont ".$request->input('amount');
                    }
                }

        # code...
        return redirect ('/home')->with('message', $message);
    } 
}


