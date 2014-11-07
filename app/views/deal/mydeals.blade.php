@extends('layouts.default')
@section("title")
	Zoek Deals | MealDeal
@stop

@section("content")
	<div>
		<h1>Mijn Deals</h1>
		<div>
			<h2>Deals die u verkoopt</h2>
				<h2>Aanvragen</h2>
				@forelse($VerkopenAangevraagt as $dealVerkopen)
					<div>
						<h3>{{$dealVerkopen->koper->naam}} wil graag deze deal</h3>
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
				@empty
				<p>U heeft nog geen aanvragen op u deals</p>
				@endforelse
				{{$VerkopenAangevraagt->links()}}
				<h2>Geaccepteert</h2>
				@forelse($VerkopenGeaccepteert as $dealVerkopen)
					<div>
						<h3>U verkoopt deze deal aan {{$dealVerkopen->koper->naam}}</h3>
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
						<p>U heeft deze deal geaccepteert</p>
						{{Form::open(['url' => 'mydeals/'.$dealVerkopen->id.'/edit','method' => 'get'])}}
						{{Form::hidden('type','afzeggen')}}
						{{Form::submit('Deal Afzeggen')}}
						{{Form::close()}}
						
					</div>
				@empty
				<p>U heeft nog geen deals die geaccepteert zijn</p>
				@endforelse
				{{$VerkopenGeaccepteert->links()}}
				<h2>Beschikbaar</h2>
				@forelse($dealsBeschikbaar as $dealBeschikbaar)
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
				@empty
				<p>U heeft geen deals beschikbaar</p>
				@endforelse
				{{$dealsBeschikbaar ->links()}}
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
						{{Form::open(['url' => 'mydeals/'.$dealVerkopen->id.'/edit','method' => 'get'])}}
						{{Form::hidden('type','aanvraag intrekken')}}
						{{Form::submit('Aaanvraag Intrekken')}}
						{{Form::close()}}
					@elseif($dealKopen->status == "geaccepteert")
						<p>U deal is geacepteert</p>
						{{Form::open(['url' => 'mydeals/'.$dealVerkopen->id.'/edit','method' => 'get'])}}
						{{Form::hidden('type','Acceptatieafzeggen')}}
						{{Form::submit('Deal Afzeggen')}}
						{{Form::close()}}
					@endif
					
				@empty
				<p>U hebt momenteel geen aanvragen gedaan</p>
				@endforelse
				{{$dealsKopen->links()}}
		</div>
		
	</div>
@stop