@extends('layouts.app')

@section('content')

<a href="/posts?page={{intval($post->id/5)+1}}" class="btn btn-default">Go Back</a>
    <h2 class="h2">{{$post->title}}</h3>
    <h5 class="h5"><small>Created on: {{$post->created_at}}</small></h5>
    <div>{!!$post->body!!}</div>
    <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
    {!!Form::open(['action' => ['PostsController@destroy',$post->id],'method'=>'POST','class' => 'pull-right'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete Post',['class'=>'btn btn-danger'])}}
    {!!Form::close()!!}
@endsection