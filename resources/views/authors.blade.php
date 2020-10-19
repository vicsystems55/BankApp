@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

        @if(Session::has('likes_message'))
            <div class="alert alert-success" role="alert">
            {{Session::get('likes_message')}}
            </div>
            @endif

        

                    <div class="row">
                         @foreach($user_data as $data)
                            <div class="col-md-10">
                    


                                <div class="card mb-3">
                                    

                                    <div class="card-body table-responsive">

                                    <img class="rounded-circle img-thumbnail" src="{{ asset('/avatars') }}/{{$data->avatar}}" alt="">

                                        <h1>{{$data->name}}</h1>



                                    </div>
                                    <div class="card-footer">

                                       
                                    <a href="{{route('single_author', $data->id)}}">view profile</a>
                            
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>



       

        

            


        </div>
    </div>
</div>
@endsection
