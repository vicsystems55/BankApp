@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

        @if(Session::has('message'))
            <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
            </div>
            @endif

        

                    <div class="row">
                        
                            <div class="col-md-10">
                    


                                <div class="card mb-3">
                                    

                                    <div class="card-body table-responsive">

                                    <img class="rounded-circle img-thumbnail" src="{{ asset('/avatars/$user_data->avatar') }}" alt="">

                                        <h1 class="display-4">{{$user_data->name}}</h1>
                                        <h4>{{$user_data->email}}</h4>
                                        <h4>{{$user_data->status}}</h4>

                                        

                                        @if($follower_data->contains('user_id', Auth::user()->id))
                                        
                                                <form class="form-inline" method="post" action="{{route('follow')}}">
                                                @csrf
                                                <div class="">
                                                    
                                                    <input type="hidden" name="author_id" value="{{$user_data->id}}">
                                                    
                                                </div>
                                                <button type="submit" class="btn btn-warning mb-2 shadow" disabled>Following {{$user_data->followers}} </button>
                                                
                                                </form>

                                            @else

                                                <form class="form-inline" method="post" action="{{route('follow')}}">
                                                @csrf
                                                <div class="">
                                                    
                                                    <input type="hidden" name="author_id" value="{{$user_data->id}}">
                                                    
                                                </div>
                                                <button type="submit" class="btn btn-warning mb-2 shadow">Following {{$user_data->followers}} </button>
                                                
                                                </form>

                                            @endif
                                   


                                    </div>
                                    <div class="card-footer">

                                       
                                    <a class="btn btn-primary shadow" href="{{route('author')}}">Authors</a>
                            
                                    </div>
                                </div>
                            </div>
                           
                    </div>



       

        

            


        </div>
    </div>
</div>
@endsection
