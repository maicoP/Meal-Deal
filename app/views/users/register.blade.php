@extends('layouts.default')
@section('content')
<h2>Register</h2>

	{{Form::open(['route' => 'users.store','files' => true]) }}
	<div>
		<span>{{ $errors->first('username')}}</span>
		<span>{{ $errors->first('password')}}</span>
		<span>{{ $errors->first('email')}}</span>
		<span>{{ $errors->first('info')}}</span>
		<span>{{ $errors->first('image')}}</span>
	</div>
	<div>
		{{Form::label('username','Username: ')}}
		{{Form::text('username')}}	
	</div>
	<div>
		{{Form::label('password','Password: ')}}
		{{Form::password('password')}}	
	</div>

	<div>
		{{Form::label('email','Email: ')}}
		{{Form::email('email')}}	
	</div>

	<div>
		{{Form::label('info','Info: ')}}
		{{Form::text('info')}}	
	</div>
	<div>
		{{Form::label('image','Avatar:')}}
		{{Form::file('image')}}
	</div>

	<div>{{Form::submit('Register')}}</div>
	

	{{Form::close() }}
@stop