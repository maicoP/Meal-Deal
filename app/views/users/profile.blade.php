@extends('layouts.logdIn')

@section('content')
	<div>
		<h1>Profile of {{$userData->naam}}</h1>
		<img src="{{'/img/'.$userData->afbeelding}}">
		<p>{{$userData->info}}</p>
		<p>Votes: {{$userData->votes}}</p>
		<p>Adres: {{$userData->straatnaam." ".$userData->huisnummer." ".$userData->postcode." ".$userData->gemeente}}
		@if($userData->postbus != "")
		Postbus:{{$userData->postbus}}
		@endif</p>
		<h2>Deals from {{$userData->naam}}</h2>
		@foreach($userData->deal as $deal )
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