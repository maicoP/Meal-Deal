@extends('layouts.logdIn')

@section('content')
	<div>
		<h1>Mijn Deals</h1>
		<div>
			<h2>Verkopen</h2>
			@if(empty($dealsBeschikbaar) && empty($dealsVerkopen))
			<p>U verkoopt geen deals.</p>
			@else
				@foreach($dealsVerkopen as $dealVerkopen)
					<div>
						<h3>{{$dealVerkopen->deal->gerecht}}</h3>
						<p>Deal einde:{{$dealVerkopen->deal->dealeinde}}</p>
						<p>Afhaaluur:{{$dealVerkopen->deal->afhaaluur}}</p>
						@if($dealVerkopen->deal->afhalen == 1)
						<p>Ontvangst: Afhalen</p>
						<h3>verkopen aan</h3>
						<span><img src="{{'/img/'.$dealVerkopen->koper->afbeelding}}">{{link_to("users/".$dealVerkopen->koper->naam, $dealVerkopen->koper->naam)}}</span>
						@else
						<p>Ontvangst: Komen Eten.</p>
						@endif
						@if($dealVerkopen->status == "aangevraagt")
							{{Form::open(['url' => 'mydeals/'.$dealVerkopen->id.'/edit','method' => 'get'])}}
							{{Form::submit('Accepteer Deal')}}
							{{Form::close()}}
						@elseif($dealVerkopen->status == "geaccepteert")
							<p>U heeft deze deal geacepteert</p>
						@endif
						
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
			@if(empty($dealsKopen))
				<p>U heeft geen lopende Deals</p>
			@else
				@foreach($dealsKopen as $dealKopen)
					<h3>{{$dealKopen->deal->gerecht}}</h3>
					<p>Deal einde:{{$dealKopen->deal->dealeinde}}</p>
					<p>Afhaaluur:{{$dealKopen->deal->afhaaluur}}</p>
					@if($dealKopen->deal->afhalen == 1)
					<p>Ontvangst: Afhalen</p>
					@else
					<p>Ontvangst: Komen Eten.</p>
					@endif
					<h3>Verkoper</h3>
					<span><img src="{{'/img/'.$dealKopen->verkoper->afbeelding}}">{{link_to("users/".$dealKopen->verkoper->naam, $dealKopen->verkoper->naam)}}</span>
					@if($dealKopen->status == "aangevraagt")
						<p>Wachten op reactie van verkoper</p>
					@elseif($dealKopen->status == "geaccepteert")
						<p>U deal is geacepteert</p>
					@endif
					
				@endforeach
			@endif
		</div>
		
	</div>
@stop