@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if (Session::has('warning'))
                        <div class="alert alert-warning" role="alert">
                            {{ Session::get('warning') }}
                        </div>
                    @endif

                   

                    @auth()

                    <h4>Account Code: {{Auth::user()->account_no}}</h4>
                    

                    {{ $message ?? '' }}

                    <h1> Current Balance:
                    <?php

                        echo 'NGN ' .number_format($balance, $decimal=2);
                        ?>
                    </h1>


                        <div class="p-1">
                        <a class="btn btn-primary btn-sm" href="{{ route('enter')}}">Record Transaction</a>
                        </div>
                        
                        <div class="p-1">
                        <a class="btn btn-warning btn-sm" href="{{ route('statement')}}">Statement of Account</a>
                        </div>
                        


                    @endauth

                    @guest
                                    <h1>You are not logged in</h1>
                    @endguest

                    {{ __('You are logged in!') }}
                </div>

                <div class="card-body table-responsive">

                <h4 class="font-weight-bold">Upline: {{$upliner->referral}}</h4>
                   
                   <h4>Total Direct Bonus Points: {{$db_points}}</h4>
                   

                   <table class="table">
                    <thead>
                        <tr>
                            <th>
                                S/N
                            </th>
                            <th>
                                Referree
                            </th>
                            <th>
                                Points
                            </th>
                            <th>
                                Date
                            </th>
                        </tr>
                    </thead>

                        <tbody>
                           @foreach($db_data as $data)

                           <tr>
                                <td>
                                {{$loop->iteration}}
                                </td>
                                <td>
                                {{$data->referree}}
                                </td>
                                <td>
                                {{$data->points}}
                                </td>
                                <td>
                                {{$data->created_at}}
                                </td>
                            </tr>


                           @endforeach
                        </tbody>
                   </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
