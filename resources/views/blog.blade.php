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
                         @foreach($blogs as $post)
                            <div class="col-md-4">
                    


                                <div class="card mb-3">
                                    <div class="card-header">{{ $post->title}}</div>

                                    <div class="card-body table-responsive">

                                        {{$post->body}}



                                    </div>
                                    <div class="card-footer">

                                        @if($likes->contains('post_id', $post->id))
                                        
                                                <form class="form-inline" method="post" action="{{route('like')}}">
                                                @csrf
                                                <div class="">
                                                    
                                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                                    
                                                </div>
                                                <button type="submit" class="btn btn-secondary mb-2" disabled>like {{$post->likes}} </button>
                                                
                                                </form>

                                            @else

                                                <form class="form-inline" method="post" action="{{route('like')}}">
                                                @csrf
                                                <div class="">
                                                    
                                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                                    
                                                </div>
                                                <button type="submit" class="btn btn-primary mb-2">like {{$post->likes}} </button>
                                                
                                                </form>

                                            @endif

                            
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>



       

        

            


        </div>
    </div>
</div>
@endsection
