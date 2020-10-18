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

    public function transfer_p()
    {
        # code...

        $user_data = DB::table('users')->get();

        return view('transfer',[
            'user_data' => $user_data
        ]);
    } 

    public function transfer(Request $request)
    {
        $current_bal = DB::table('transactions')->where('user_id', Auth::user()->id)->sum('amount');

        $receipient_data = DB::table('users')->where('account_no', $request->receipient_accnt)->first();

        if (($request->amount)> $current_bal) {
            # code.
            return redirect('/transfer')->with('warning', 'Insuffient to make this transfer');
        }

        if($receipient_data->status =='active'){

            $req_amount = $request->amount * -1;

            Transaction::create([
                'amount' => $req_amount,
                'type' => 'debit',
                'user_id' => Auth::user()->id,
                
            ]);

            $req_amount = $request->amount;

            Transaction::create([
                'amount' => $req_amount,
                'type' => 'credit',
                'user_id' => $receipient_data->id,
                
            ]);

            return redirect('/transfer')->with('success', 'Your Transfer was successful');

           

        }else{

            return redirect('/transfer')->with('warning', 'Receipient cannot receive funds');
        }

        
    }

    public function transact(Request $request)
    {
        $transaction = new Transaction;

        $current_bal = DB::table('transactions')->where('user_id', Auth::user()->id)->sum('amount');

        if ($request->type == 'debit') {
            # code...
            if ($current_bal < $request->amount) {
                # code...
                return redirect('/home')->with('warning', 'insufficient balance');

            }else{
            
            $transaction_amount = $request->input('amount') * -1;

            $transaction->type = $request->input('type');
            $transaction->amount = $transaction_amount;
            $transaction->user_id = Auth::user()->id;

            $transaction->save();

            return redirect('/home')->with('success', 'Debit Transaction Posted');

            }


        }

        if ($request->type == 'credit') {
            # code...
            if( ($current_bal + ($request->amount) ) > 100000){

                return redirect('/home')->with('warning', 'your balance limit will be exceeded');

            }else{

           

            $transaction->type = $request->input('type');
            $transaction->amount = $request->input('amount');
            $transaction->user_id = Auth::user()->id;

            $transaction->save();

            return redirect('/home')->with('success', 'Credit Transaction Posted');

            }
        }



        
       
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


