@extends('layouts.default')
@section("title")
	Mijn Deals | MealDeal
@stop

@section("content")
	<div>
		<h1>Mijn Deals</h1>
		<div>
			<h2>Deals die u verkoopt</h2>
				@if($VerkopenAangevraagt->isEmpty() && $VerkopenGeaccepteert->isEmpty() && $dealsBeschikbaar->isEmpty())
					<p>U hebt momenteel geen deals die u verkoopt.</p>
				@else
					@if(!$VerkopenAangevraagt->isEmpty())
						<h2>Aanvragen</h2>
						@foreach($VerkopenAangevraagt as $dealVerkopen)
							<div>
								<h3>{{link_to("users/".$dealVerkopen->koper->naam, $dealVerkopen->koper->naam)}} wil graag een portie van {{$dealVerkopen->deal->gerecht}}</h3>
								<img src="{{strpos($dealVerkopen->koper->afbeelding,'https') !== false ?$dealVerkopen->koper->afbeelding : '/img/'.$dealVerkopen->koper->afbeelding}}">
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
						{{$VerkopenAangevraagt->links()}}
					@endif
					@if(!$VerkopenGeaccepteert->isEmpty())
						<h2>Geaccepteert</h2>
						@foreach($VerkopenGeaccepteert as $dealVerkopen)
							<div>
								<h3>U verkoopt een portie van {{$dealVerkopen->deal->gerecht}} aan {{link_to("users/".$dealVerkopen->koper->naam, $dealVerkopen->koper->naam)}}</h3>
								<p>Koper: </p>
								<img src="{{strpos($dealVerkopen->koper->afbeelding,'https') !== false ?$dealVerkopen->koper->afbeelding : '/img/'.$dealVerkopen->koper->afbeelding}}">
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
						@endforeach
						{{$VerkopenGeaccepteert->links()}}
					@endif
					
					@if(!$dealsBeschikbaar->isEmpty())
					<h2>Beschikbaar</h2>
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
						{{$dealsBeschikbaar ->links()}}
					@endif
				@endif
		</div>
		<div>
			<h2>Kopen</h2>
				@forelse($dealsKopen as $dealKopen)
					<h3>{{$dealKopen->deal->gerecht}}</h3>
					<p>Verkoper: </p>
					<span><img src="{{strpos($dealKopen->verkoper->afbeelding,'https') !== false ?$dealKopen->verkoper->afbeelding : '/img/'.$dealKopen->verkoper->afbeelding}}">
						<img src="{{'/img/badges/'.$dealKopen->verkoper->badge.'.png'}}" alt="">{{link_to("users/".$dealKopen->verkoper->naam, $dealKopen->verkoper->naam)}}</span>
					<p>Adress:{{$dealKopen->koper->straatnaam." ".$dealKopen->koper->huisnummer."<br>".$dealKopen->koper->postcode." ".$dealKopen->koper->gemeente}}</p>
					@if($dealKopen->koper->postbus != "")
					<br>Postbus: {{$dealKopen->koper->postbus}}
					@endif
					<p>Beschrijving:{{$dealKopen->deal->beschrijving}} </p>
					<p>Deal einde:{{$dealKopen->deal->dealeinde}}</p>
					<p>Afhaaluur:{{$dealKopen->deal->afhaaluur}}</p>
					@if($dealKopen->deal->afhalen == 1)
					<p>Ontvangst: Afhalen</p>
					@else
					<p>Ontvangst: Komen Eten.</p>
					@endif
					@if($dealKopen->status == "aangevraagt")
						<p>Wachten op reactie van verkoper</p>
						{{Form::open(['url' => 'mydeals/'.$dealKopen->id.'/edit','method' => 'get'])}}
						{{Form::hidden('type','aanvraag intrekken')}}
						{{Form::submit('Aaanvraag Intrekken')}}
						{{Form::close()}}
					@elseif($dealKopen->status == "geaccepteert")
						<p>U deal is geacepteert</p>
						{{Form::open(['url' => 'mydeals/'.$dealKopen->id.'/edit','method' => 'get'])}}
						{{Form::hidden('type','Acceptatieafzeggen')}}
						{{Form::submit('Deal Afzeggen')}}
						{{Form::close()}}
					@endif

					<img src="{{'/img/deals/'.$dealKopen->deal->afbeeldingdeal}}" alt="">
					
				@empty
				<p>U hebt momenteel geen aanvragen gedaan</p>
				@endforelse
				{{$dealsKopen->links()}}
		</div>
		
	</div>
@stop