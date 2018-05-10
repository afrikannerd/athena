@extends('layouts.app')
@section('content')
    
        <h3>{{$title}}</h3>
        @if(count($posts) > 0 )
        @foreach($posts as $post)
            <div>
            <h3 class="h4"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <h5><small>Written on {{$post->created_at}}</small></h5>
            </div>
        @endforeach
        {{$posts->links()}}
        @else
            <h3 class="h4">No posts yet</h3>
        @endif
    
@endsection