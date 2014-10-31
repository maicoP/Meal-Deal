@extends('layouts.logdIn')

@section('content')
	<h1>Profiel Wijzigen</h1>
	<div>
		{{Link_to("#","Profiel wijzigen")}}
		{{Link_to("#","Wachtwoord wijzigen")}}
	</div>
	<div>
		<h2>Profile of {{$userData->naam}}</h2>
		<img src="{{'/img/'.$userData->afbeelding}}">
		<p>{{$userData->info}}</p>
		<p>Votes: {{$userData->votes}}</p>
		<p>Regio: {{$userData->naamRegio}}</p>
		<p>Gemeente: {{$userData->gemeente}}</p>
		<p>Straatnaam: {{$userData->straatnaam}}
		<p>Postcode: {{$userData->postcode}}</p>
		<p>Huisnummer: {{$userData->huisnummer}}</p>
		<p>Postbus: {{$userData->postbus}}</p>	
	</div>
@stop