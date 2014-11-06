@extends('layouts.default')
@section("title")
	Zoek Deals | MealDeal
@stop

@section("content")
	<div>
		<h1>Mijn Deals</h1>
		<div>
			<h2>Verkopen</h2>
			@if( $dealsBeschikbaar->isEmpty() == 1 && $VerkopenGeaccepteert->isEmpty() == 1 && $VerkopenAangevraagt->isEmpty() == 1)
			<p>U verkoopt geen deals.</p>
			@else
				@foreach($VerkopenAangevraagt as $dealVerkopen)
					<div>
						<h2>{{$dealVerkopen->koper->naam}} wil graag deze deal</h2>
						<p>Koper: </p>
						<span><img src="{{strpos($dealVerkopen->koper->afbeelding,'https') !== false ?$dealVerkopen->koper->afbeelding : '/img/'.$dealVerkopen->koper->afbeelding}}">{{link_to("users/".$dealVerkopen->koper->naam, $dealVerkopen->koper->naam)}}</span>
						<h3>{{$dealVerkopen->deal->gerecht}}</h3>
						<p>Deal einde:{{$dealVerkopen->deal->dealeinde}}</p>
						<p>Afhaaluur:{{$dealVerkopen->deal->afhaaluur}}</p>
						@if($dealVerkopen->deal->afhalen == 1)
						<p>Ontvangst: Afhalen</p>
						@else
						<p>Ontvangst: Komen Eten.</p>
						@endif
						{{Form::open(['url' => 'mydeals/'.$dealVerkopen->id.'/edit','method' => 'get'])}}
						{{Form::hidden('type','accepteer')}}
						{{Form::submit('Accepteer Deal')}}
						{{Form::close()}}
						{{Form::open(['url' => 'mydeals/'.$dealVerkopen->id.'/edit','method' => 'get'])}}
						{{Form::hidden('type','wijger')}}
						{{Form::submit('Wijger Deal')}}
						{{Form::close()}}
						
					</div>
				@endforeach
				@foreach($VerkopenGeaccepteert as $dealVerkopen)
					<div>
						<h2>U verkoopt deze deal aan{{$dealVerkopen->koper->naam}}</h2>
						<p>Koper: </p>
						<span><img src="{{strpos($dealVerkopen->koper->afbeelding,'https') !== false ?$dealVerkopen->koper->afbeelding : '/img/'.$dealVerkopen->koper->afbeelding}}">{{link_to("users/".$dealVerkopen->koper->naam, $dealVerkopen->koper->naam)}}</span>
						<h3>{{$dealVerkopen->deal->gerecht}}</h3>
						<p>Deal einde:{{$dealVerkopen->deal->dealeinde}}</p>
						<p>Afhaaluur:{{$dealVerkopen->deal->afhaaluur}}</p>
						@if($dealVerkopen->deal->afhalen == 1)
						<p>Ontvangst: Afhalen</p>
						@else
						<p>Ontvangst: Komen Eten.</p>
						@endif
						<p>U heeft deze deal geacepteert</p>
						
					</div>
				@endforeach
				@foreach($dealsBeschikbaar as $dealBeschikbaar)
					<div>
						<h3>{{$dealBeschikbaar->deal->gerecht}}</h3>
						<p>Deal einde:{{$dealBeschikbaar->deal->dealeinde}}</p>
						<p>Afhaaluur:{{$dealBeschikbaar->deal->afhaaluur}}</p>
						@if($dealBeschikbaar->deal->afhalen == 1)
						<p>Ontvangst: Afhalen</p>
						@else
						<p>Ontvangst: Komen Eten.</p>
						@endif
						<p>Deal is nog vrij</p>
					</div>
				@endforeach
			@endif
		</div>
		<div>
			<h2>Kopen</h2>
				@forelse($dealsKopen as $dealKopen)
					<h3>{{$dealKopen->deal->gerecht}}</h3>
					<p>Verkoper: </p>
					<span><img src="{{strpos($dealKopen->verkoper->afbeelding,'https') !== false ?$dealKopen->verkoper->afbeelding : '/img/'.$dealKopen->verkoper->afbeelding}}">{{link_to("users/".$dealKopen->verkoper->naam, $dealKopen->verkoper->naam)}}</span>
					<p>Deal einde:{{$dealKopen->deal->dealeinde}}</p>
					<p>Afhaaluur:{{$dealKopen->deal->afhaaluur}}</p>
					@if($dealKopen->deal->afhalen == 1)
					<p>Ontvangst: Afhalen</p>
					@else
					<p>Ontvangst: Komen Eten.</p>
					@endif
					@if($dealKopen->status == "aangevraagt")
						<p>Wachten op reactie van verkoper</p>
					@elseif($dealKopen->status == "geaccepteert")
						<p>U deal is geacepteert</p>
					@endif
					
				@empty
				<p>U hebt momenteel geen aanvragen gedaan</p>
				@endforelse
		</div>
		
	</div>
@stop