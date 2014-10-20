@extends('layouts.logdIn')

@section('content')
	<div>
		<h1>Profile of {{$user->naam}}</h1>
		<img src="{{'/img/'.$user->afbeelding}}">
		<p>{{$user->info}}</p>
		<p>Votes: {{$user->votes}}</p>
		<p>Adres: {{$user->straatnaam." ".$user->huisnummer." ".$user->postcode." ".$user->gemeente}}
		@if($user->postbus != "")
		Postbus:{{$user->postbus}}
		@endif</p>
		<h2>Deals from {{$user->naam}}</h2>
		@foreach($deals as $deal )
			<div>
					<h2>
						{{$deal->gerecht}}
					</h2>
					<div><img src="{{'/img/deals/'.$deal->afbeeldingdeal}}"></div>
					@if($deal->afhalen == 1)
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
		@endforeach
	</div>
	
@stop