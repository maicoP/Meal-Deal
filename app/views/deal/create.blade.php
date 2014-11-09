@extends('layouts.default')
@section("title")
	Deal Plaatsen | MealDeal
@stop

@section("content")
	<h1>Deal Plaatsen</h1>

	<div>
		<div class="selectors">
		<div class="submitdeal">
		{{ Form::open(['route' => 'deals.store','files' => true]) }}
			<div>
				@if(Session::has('message') )
					{{Session::get('message')}}
				@endif
				<div class="regerror">{{ $errors->first('naam')}}</div>
				<div class="regerror">{{ $errors->first('porties')}}</div>
				<div class="regerror">{{ $errors->first('afbeelding')}}</div>
				<div class="regerror">{{ $errors->first('dealeinde')}}</div>
				<div class="regerror">{{ $errors->first('afhaaluur')}}</div>
				<div class="regerror">{{ $errors->first('afhalen')}}</div>
			</div>

			<p>
				{{ Form::label('gerecht','Gerecht:', array('data-icon' => '&#xf1b1;'))}}
				{{ Form::text('gerecht','', array('required' => 'required'))}}
			</p>

			<p>
				{{ Form::label('porties','Aantal Porties:')}}
				{{  Form::selectRange('porties', 1, 20)}}
				
			</p>

			<p class="camera">
				{{ Form::label('afbeeldingdeal','Afbeelding:', array('data-icon' => '&#xf030;'))}}
				{{ Form::file('afbeeldingdeal')}}
				
			</p>

			<p>
				{{ Form::label('dealeinde','Deal Einde:', array('data-icon' => '&#xf017;'))}}
				<input required="required" placeholder="--:--" type="time" name="dealeinde">
			</p>

			<p>
				{{ Form::label('afhaaluur','Afhaaluur:', array('data-icon' => '&#xf0f5;'))}}
				<input required="required" placeholder="--:--" type="time" name="afhaaluur">
			</p>

			<p>
				{{ Form::label('afhalen','Ontvangst:')}}
				{{Form::select('afhalen', array(true => 'Afhalen', false => 'Komen eten'))}}

			</p>

			<p>
				{{ Form::label('beschrijving','Beschrijving:')}}
				{{Form::textarea('beschrijving','',array('maxlength' => '200'))}}

			</p>

			<p class="submit-button">
				{{ Form::submit('DEAL PLAATSEN', ['class' => 'inloggen','value' => 'DEAL PLAATSEN'])}}
			</p>
		{{ Form::close() }}
		</div>
		</div>
		
	</div>
@stop