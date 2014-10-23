@extends('layouts.default')

@section('content')
	<div class="authencication">
		{{ Form::open(['route' => 'sessions.store']) }}
			<div class="login">
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
			<div class="down">
				{{ Form::submit('Log in', ['class' => 'button'])}}
			</div>
			{{ Form::close() }}
			</div>
			<div class="register">
			<h3>Registreer</h3>
			<p class="registersubtitle"><b>Je gratis account</b></p>
			<p class="registertext">Begin binnen enkele minuten deals te claimen en deals te doneren</p>
			<div class="down downplus">{{link_to("users/create", "Registreer", ['class' => 'button'])}}</div>
			</div>
	</div>
@stop