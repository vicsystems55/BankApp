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

                    {{ $message ?? '' }}

                    <h1> Current Balance:
                    <?php

                        echo 'NGN ' .number_format($balance, $decimal=2);
                        ?>
                    </h1>



                        <a class="btn btn-primary btn-sm" href="{{ route('enter')}}">Record Transaction</a>
                        <br>
                        <a class="btn btn-warning btn-sm" href="{{ route('statement')}}">Statement of Account</a>


                    @endauth

                    @guest
                                    <h1>You are not logged in</h1>
                    @endguest

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
