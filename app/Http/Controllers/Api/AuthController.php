<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use App\User;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
             $user = $request->user();
             $data['token'] = $user->createToken('MyApp')->accessToken;
             $data['name']  = $user->name;
             return response()->json($data, 200);
         }

       return response()->json(['error'=>'Unauthorized'], 401);
    }

    public function register(Request $request)
    {

      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
      ]);

      if ($validator->fails()) {
          return response()->json(['error'=>$validator->errors()], 401);
      }
      $regCode = "VICOINS-2020-" .rand(111,999);
      $user = $request->all();
      $user['password'] = Hash::make($user['password']);
      $user['account_no'] = $regCode;
      
      $user = User::create($user);
      $success['token'] =  $user->createToken('MyApp')-> accessToken; 
      $success['name'] =  $user->name;

      return response()->json([
        'success'=>$success,
        'error' => $validator->errors
      
      ], 200); 
    }

    public function userDetail()
    {
        $user = Auth::user();

        return response()->json(['user' => $user], 200);
    }

}