@extends('layouts.default')
@section("title")
	Zoek Deals | MealDeal
@stop

@section("content")
	<h1>Deal Plaatsen</h1>

	<div>
		{{ Form::open(['route' => 'deals.store','files' => true]) }}
			<div>
				{{ $errors->first('naam')}}
				{{ $errors->first('porties')}}
				{{ $errors->first('afbeelding')}}
				{{ $errors->first('dealeinde')}}
				{{ $errors->first('afhaaluur')}}
				{{ $errors->first('afhalen')}}
			</div>

			<div>
				{{ Form::label('gerecht','Gerecht:')}}
				{{ Form::text('gerecht')}}
				
			</div>

			<div>
				{{ Form::label('porties','Aantal Porties:')}}
				{{  Form::selectRange('porties', 1, 20)}}
				
			</div>

			<div>
				{{ Form::label('afbeeldingdeal','Afbeelding:')}}
				{{ Form::file('afbeeldingdeal')}}
				
			</div>

			<div>
				{{ Form::label('dealeinde','Deal Einde:')}}
				<input type="time" name="dealeinde">
			</div>

			<div>
				{{ Form::label('afhaaluur','Afhaaluur:')}}
				<input type="time" name="afhaaluur">
			</div>

			<div>
				{{ Form::label('afhalen','Ontvangst:')}}
				{{Form::select('afhalen', array(true => 'Afhalen', false => 'Komen eten'))}}

			</div>

			<div>
				{{ Form::submit('Plaats')}}
			</div>
		{{ Form::close() }}
		
	</div>
@stop