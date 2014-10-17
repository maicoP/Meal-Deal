@extends('layouts.default')

@section('content')
	<h1>Home</h1>

	<div>
		{{ Form::open(['route' => 'sessions.store']) }}
			<h3>Log in</h3>
			<div>
				{{ $errors->first('email')}}
				{{ $errors->first('password')}}
			</div>
			<div>
				{{ Form::label('email','Email:')}}
				{{ Form::email('email')}}
				
			</div>

			<div>
				{{ Form::label('password','Password:')}}
				{{ Form::password('password')}}
				
			</div>
			<div>
				{{ Form::submit('Login')}}
				{{link_to("users/create", "Register")}}
			</div>
		{{ Form::close() }}
		
	</div>
@stop