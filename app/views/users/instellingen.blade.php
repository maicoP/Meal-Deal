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
		<img src="{{'/img/badges/'.$userData->badge.'.png'}}" alt="">
		<p>{{$userData->info}}</p>
		<p>Votes: {{$userData->votes}}</p>
		<p>School: {{$userData->school->naam}}</p>
		<p>Regio: {{$userData->region->naamRegio}}</p>
		<p>Gemeente: {{$userData->gemeente}}</p>
		<p>Straatnaam: {{$userData->straatnaam}}
		<p>Postcode: {{$userData->postcode}}</p>
		<p>Huisnummer: {{$userData->huisnummer}}</p>
		<p>Postbus: {{$userData->postbus}}</p>
		<p>Aantal verkochte deals: {{$dealsVerkocht}}</p>
		<p>Aantal gekochte deals: {{$dealsGekocht}}</p>	
	</div>
	<div>
		@forelse($userDeals as $deal )
			<div>
					<h2>
						{{$deal->gerecht}}
					</h2>
					<div><img src="{{'/img/deals/'.$deal->afbeeldingdeal}}"></div>
					@if($deal->afhalen == 1)
					<p>{{$deal->beschrijving}}</p>
					<p>Ontvangst: Afhalen</p>
					@else
					<p>Ontvangst: Komen Eten.</p>
					@endif
					<p>Beschikbare Porties: {{$deal->porties}}</p>
					<p>Datum: {{substr($deal->created_at, 0, 10);}}</p>
					<p>Deal einde:{{$deal->dealeinde}}</p>
					<p>Afhaaluur:{{$deal->afhaaluur}}</p>
					@if($deal->beschikbaar == 1)
					<p>Beschikbaar</p>
					@else
					<p>Niet meer Beschikbaar</p>
					@endif

				</div>
		@empty
			<p>{{$userData->naam}} heeft nog geen deals geplaats</p>
		@endforelse
		{{$userDeals->links()}}
	</div>
	

@stop