@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-2">
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
                        <a class="btn btn-primary btn-sm col-md-3 shadow" href="{{ route('enter')}}">Record Transaction</a>
                        </div>
                        
                        <div class="p-1">
                        <a class="btn btn-warning btn-sm col-md-3 shadow" href="{{ route('statement')}}">Statement of Account</a>
                        </div>
                        


                    @endauth

                    @guest
                                    <h1>You are not logged in</h1>
                    @endguest

                    {{ __('You are logged in!') }}
                </div>

                
            </div>

            <div class="card mb-2">
                <div class="card-header">{{ __('Earnings') }}</div>
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

            <div class="card ">
                <div class="card-header">Geanology</div>
                <div class="card-body">
                    Matching Bonus

                    <tabl style="width:100%;">
                    @foreach($user_data as $data)

                        
                            <div style="width: 100%;" class="on border shadow mb-4 text-center">
                                                       
                                        <!-- <h1 style="width: 120px; height:90px;" class="text-center bg-primary d-inline p-2">us</h1> -->
                                        




                            </div>
                        

                        @endforeach
                                            </table>

                   

                </div>
            </div>

            <div class="card">
                <dic class="card-header"></dic>
                <div class="card-body">
                @php
$array = array(array('metaname' => 'color', 'metavalue' => 'blue'),
                array('metaname' => 'size', 'metavalue' => 'big'));
@endphp
<h3>Buy Movie Tickets N500.00</h3>
<form method="POST" action="{{ route('pay') }}" id="paymentForm">
    {{ csrf_field() }}
    <input type="hidden" name="amount" value="500" /> <!-- Replace the value with your transaction amount -->
    <input type="hidden" name="payment_method" value="both" /> <!-- Can be card, account, both -->
    <input type="hidden" name="description" value="Beats by Dre. 2017" /> <!-- Replace the value with your transaction description -->
    <input type="hidden" name="country" value="NG" /> <!-- Replace the value with your transaction country -->
    <input type="hidden" name="currency" value="NGN" /> <!-- Replace the value with your transaction currency -->
    <input type="hidden" name="email" value="test@test.com" /> <!-- Replace the value with your customer email -->
    <input type="hidden" name="firstname" value="Oluwole" /> <!-- Replace the value with your customer firstname -->
    <input type="hidden" name="lastname" value="Adebiyi" /> <!-- Replace the value with your customer lastname -->
    <input type="hidden" name="metadata" value="{{ json_encode($array) }}" > <!-- Meta data that might be needed to be passed to the Rave Payment Gateway -->
    <input type="hidden" name="phonenumber" value="090929992892" /> <!-- Replace the value with your customer phonenumber -->
    {{-- <input type="hidden" name="paymentplan" value="362" /> <!-- Ucomment and Replace the value with the payment plan id --> --}}
    {{-- <input type="hidden" name="ref" value="MY_NAME_5uwh2a2a7f270ac98" /> <!-- Ucomment and  Replace the value with your transaction reference. It must be unique per transaction. You can delete this line if you want one to be generated for you. --> --}}
    {{-- <input type="hidden" name="logo" value="https://pbs.twimg.com/profile_images/915859962554929153/jnVxGxVj.jpg" /> <!-- Replace the value with your logo url (Optional, present in .env)--> --}}
    {{-- <input type="hidden" name="title" value="Flamez Co" /> <!-- Replace the value with your transaction title (Optional, present in .env) --> --}}
    <input type="submit" value="Buy"  />
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
