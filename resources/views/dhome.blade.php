@extends('layouts.layout2')


@section('my_content')


<div>
    <h1>Welcome to d home</h1>

    <h2>Welcome, </h2>


    <div class="col-md-9">
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

