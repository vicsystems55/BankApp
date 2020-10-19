@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body table-responsive">

                
                    

                    <table class="table">
                        <thead>
                            <th>s/n</th>
                            <th>Account Holder</th>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Balance</th>
                        </thead>

                        <tbody>

                                @foreach($transactions as $transaction)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $transaction->users->name}}</td>
                                    <td>{{ $transaction->type}}</td>
                                    <td>{{ $transaction->amount}}</td>
                                    <td>{{ $transaction->balance}}</td>

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
