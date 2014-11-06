@extends('layouts.default')
@section("title")
	Zoek Deals | MealDeal
@stop

@section("content")
	<div class='col-md-12 text-center'>
		<div class="page-header">
			<h1>Edit Password</h1>
		</div>

		@if(isset($message))
			<p>{{$message}}</p>	
		@endif
		{{Form::open(['url' => 'user/savePassword','method' => 'POST']) }}
		<div class="col-md-8 col-md-offset-2">
			@if(Session::get('errorsPrecent') == true)
				<div class="alert alert-danger">
					<div>{{ $errors->first('password')}}</div>
					<div>{{ $errors->first('newpassword')}}</div>
				</div>
			@endif
			<div>{{Form::label('password','Password:')}}
				 {{Form::password('password',array('type' => 'password','required' => 'required'))}}</div>
			<div>{{Form::label('newpassword','New Password:')}}
				 {{Form::password('newpassword',array('type' => 'password','required' => 'required'))}}</div>
			<div>{{Form::submit('Edit')}}</div>
		</div>
		{{Form::close() }}

	</div>
	
@stop