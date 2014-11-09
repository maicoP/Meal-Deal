@extends('layouts.default')
@section("title")
	Zoek Deals | MealDeal
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
				{{ $errors->first('naam')}}
				{{ $errors->first('porties')}}
				{{ $errors->first('afbeelding')}}
				{{ $errors->first('dealeinde')}}
				{{ $errors->first('afhaaluur')}}
				{{ $errors->first('afhalen')}}
			</div>

			<p>
				{{ Form::label('gerecht','Gerecht:', array('data-icon' => '&#xf1fa;'))}}
				{{ Form::text('gerecht','', array('placeholder' => 'Email','required' => 'required'))}}
			</p>

			<p>
				{{ Form::label('porties','Aantal Porties:')}}
				{{  Form::selectRange('porties', 1, 20)}}
				
			</p>

			<p>
				{{ Form::label('afbeeldingdeal','Afbeelding:')}}
				{{ Form::file('afbeeldingdeal')}}
				
			</p>

			<p>
				{{ Form::label('dealeinde','Deal Einde:')}}
				<input required="required" placeholder="--:--" type="time" name="dealeinde">
			</p>

			<p>
				{{ Form::label('afhaaluur','Afhaaluur:')}}
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

			<p>
				{{ Form::submit('Plaats')}}
			</p>
		{{ Form::close() }}
		</div>
		</div>
		
	</div>
@stop