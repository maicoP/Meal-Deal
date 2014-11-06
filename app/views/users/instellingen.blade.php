@extends('layouts.default')
@section("title")
	Zoek Deals | MealDeal
@stop

@section("content")
	<h1>Instellingen</h1>
	<div>
		{{Link_to("users/".$userData->naam."/edit","Profiel wijzigen")}}
		{{Link_to("user/editPassword","Wachtwoord wijzigen")}}
	</div>
	<div>
		<h2>Profile of {{$userData->naam}}</h2>
		<img src="{{strpos($userData->afbeelding,'https') !== false ?$userData->afbeelding : '/img/'.$userData->afbeelding}}">
		<p>{{$userData->info}}</p>
		<p>Votes: {{$userData->votes}}</p>
		<p>Regio: {{$userData->region->naamRegio}}</p>
		<p>Gemeente: {{$userData->gemeente}}</p>
		<p>Straatnaam: {{$userData->straatnaam}}
		<p>Postcode: {{$userData->postcode}}</p>
		<p>Huisnummer: {{$userData->huisnummer}}</p>
		<p>Postbus: {{$userData->postbus}}</p>	
	</div>

@stop