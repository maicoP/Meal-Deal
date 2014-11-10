@extends('layouts.default')
@section("title")
	Wachtwoord Wijzigen | MealDeal
@stop

@section("content")
	<div>
		<div class="page-header">
			<h1>Wachtwoord wijzigen</h1>
		</div>
		<div class="selectors">
		<div class="submitdeal">
			{{Form::open(['url' => 'user/savePassword','method' => 'POST']) }}
				@if(Session::get('errorsPrecent') == true)
					<div class="regerror">{{ $errors->first('password')}}</div>
					<div class="regerror">{{ $errors->first('newpassword')}}</div>
					@if(isset($message))
						<div class="regerror">{{$message}}</div>
					@endif
				@endif
				<div>{{Form::label('password','Huidig wachtwoord:', array('data-icon' => '&#xf084;'))}}
					 {{Form::password('password',array('type' => 'password','required' => 'required'))}}</div>
				<div>{{Form::label('newpassword','Nieuw wachtwoord:', array('data-icon' => '&#xf084;'))}}
					 {{Form::password('newpassword',array('type' => 'password','required' => 'required'))}}</div>
				<div>{{Form::submit('WIJZIGEN', ['class' => 'inloggen'])}}</div>
			{{Form::close() }}
		</div>
		</div>

	</div>
	
@stop