@extends('layouts.app')


@section('content')


<div>
    <h1>Create Post</h1>

    <div class="col-md-9">

            @if(Session::has('message'))
            <div class="alert alert-primary" role="alert">
            {{Session::get('message')}}
            </div>
            @endif
            <form method="post" action="{{route('create_postx')}}">
                @csrf
                <div class="form-group">
                <label for="">Type</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="body" id="" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>

            <div id="editor">
                    <div id='edit' style="margin-top: 30px;">
                        

                        

                    </div>

                      

                        
            </div>


    </div>
</div>


@endsection

