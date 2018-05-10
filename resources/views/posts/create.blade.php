@extends('layouts.app')
@section('content')
    <h3>{{$title}}</h3>
    {!! Form::open(['action' => 'PostsController@store']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title','',['class' => 'form-control','placeholder'=>'Title'])}}
            
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body','',['class' => 'form-control','placeholder'=>'Body goes here','id'=>'article-ckeditor' ])}}
            
        </div>
        {{Form::submit('Post',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection