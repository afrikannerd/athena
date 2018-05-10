@extends('layouts.app')
@section('content')
		<h3>Services Page</h3>
		
		@if(count($services) > 0)
			<ul class="list-group">
		 	@foreach($services as $service)
				<li class="list-group-item"><small>{{strtolower($service)}}</small></li>
			 @endforeach
			</ul>
		@endif
@endsection
