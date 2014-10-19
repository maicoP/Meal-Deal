@extends('layouts.default')
@section('content')
<h2>Register</h2>

	{{Form::open(['route' => 'users.store','files' => true]) }}
	<div>
		<span>{{ $errors->first('naam')}}</span>
		<span>{{ $errors->first('password')}}</span>
		<span>{{ $errors->first('email')}}</span>
		<span>{{ $errors->first('straatnaam')}}</span>
		<span>{{ $errors->first('postcode')}}</span>
		<span>{{ $errors->first('gemeente')}}</span>
		<span>{{ $errors->first('info')}}</span>
		<span>{{ $errors->first('afbeelding')}}</span>
	</div>
	<div>
		{{Form::label('naam','Naam: ')}}
		{{Form::text('naam')}}	
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
		{{Form::label('regionId','Regio: ')}}
		{{Form::select('regionId', $regions)}}	
	</div>

	<div>
		{{Form::label('straatnaam','Straatnaam: ')}}
		{{Form::text('straatnaam')}}	
	</div>

	<div>
		{{Form::label('postcode','Postcode: ')}}
		{{Form::text('postcode')}}	
	</div>

	<div>
		{{Form::label('gemeente','Gemeente: ')}}
		{{Form::text('gemeente')}}	
	</div>

	<div>
		{{Form::label('postbus','Postbus: ')}}
		{{Form::text('postbus')}}	
	</div>

	<div>
		{{Form::label('info','Info: ')}}
		{{Form::textarea('info')}}	
	</div>
	<div>
		{{Form::label('afbeelding','Avatar:')}}
		{{Form::file('afbeelding')}}
	</div>

	<div>{{Form::submit('Register')}}</div>
	

	{{Form::close() }}
@stop