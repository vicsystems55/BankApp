@extends('layouts.app')


@section('content')


<div>
    <h1 class="display-4">Welcome to ViCoins</h1>
    <h4>{{Auth::user()->account_no}}</h4>

    <h2>Welcome, {{Auth::user()->name}}</h2>


    <div class="col-md-6 mx-auto">
    <form method="post" action="{{route('post_trans')}}">
    @csrf
        <div class="form-group">
        <label for="">Type</label>
            <select class="form-control" name="type" id="">
                <option value="debit">Debit</option>
                <option value="credit">Credit</option>
            </select>
        </div>
        <div class="form-group">
            <input step="0.01" class="form-control" name="amount" placeholder="amount" type="number">
        </div>

       

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
    </div>
</div>


@endsection

