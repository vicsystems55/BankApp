@extends('layouts.app')


@section('content')


<div class="col-md-10 mx-auto">

        <div>
            <h1 class="display-4">Welcome to ViCoins</h1>
            <h4>{{Auth::user()->account_no}}</h4>

            <h2>Welcome, {{Auth::user()->name}}</h2>

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

            <div class="col-md-9">
            <form method="post" action="{{route('transfer')}}">
            @csrf
                <div class="form-group">
                <label for="">Receipient Account Number</label>
                <select class="form-control" name="receipient_accnt" id="">

                @foreach($user_data as $data)

                    <option value="{{$data->account_no}}">{{$data->account_no}}</option>
                @endforeach
                    <option value=""></option>
                </select>
                </div>
                <div class="form-group">
                    <input step="0.01" class="form-control" name="amount" placeholder="amount" type="number">
                </div>

            

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">POST</button>
                </div>
            </form>
            </div>
        </div>



</div>


@endsection

