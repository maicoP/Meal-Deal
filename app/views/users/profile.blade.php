@extends('layouts.default')
@section("title")
	Zoek Deals | MealDeal
@stop

@section("content")
	<div>
		<h1>Profile of {{$user->naam}}</h1>
		<img src="{{strpos($user->afbeelding,'https') !== false ?$user->afbeelding : '/img/'.$user->afbeelding}}">
		<img src="{{'/img/badges/'.$user->badge.'.png'}}" alt="">
		<p>{{$user->info}}</p>
		<p>Aantal verkochte deals: {{$dealsVerkocht}}</p>
		<p>Aantal gekochte deals: {{$dealsGekocht}}</p>
		<p>Votes: {{$user->votes}}</p>
		@if(!in_array ( $user->id , $userVotedOn))
			<div>
				{{Form::open(['url' => 'user/'.$user->id.'/vote'])}}
				{{Form::submit('vote')}}
				{{Form::close()}}
			</div>
		@endif
		
		<p>Adres: {{$user->straatnaam." ".$user->huisnummer." ".$user->postcode." ".$user->gemeente}}
		@if($user->postbus != "")
		Postbus:{{$user->postbus}}
		@endif</p>
		<p>School: {{$user->school->naam}}</p>
		<h2>Deals from {{$user->naam}}</h2>
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
			<p>{{$user->naam}} heeft nog geen deals geplaats</p>
		@endforelse
		{{$userDeals->links()}}
		
	</div>
	
@stop