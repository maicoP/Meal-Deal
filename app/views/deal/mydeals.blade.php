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
						<h3>{{$dealVerkopen->gerecht}}</h3>
						<p>Deal einde:{{$dealVerkopen->dealeinde}}</p>
						<p>Afhaaluur:{{$dealVerkopen->afhaaluur}}</p>
						@if($dealVerkopen->afhalen == 1)
						<p>Ontvangst: Afhalen</p>
						<h3>Kopen door</h3>
						<span><img src="{{'/img/'.$dealVerkopen->afbeelding}}">{{link_to("users/$dealVerkopen->naam", $dealVerkopen->naam)}}</span>
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
						<h3>{{$dealBeschikbaar->gerecht}}</h3>
						<p>Deal einde:{{$dealBeschikbaar->dealeinde}}</p>
						<p>Afhaaluur:{{$dealBeschikbaar->afhaaluur}}</p>
						@if($dealBeschikbaar->afhalen == 1)
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
					<h3>{{$dealKopen->gerecht}}</h3>
					<p>Deal einde:{{$dealKopen->dealeinde}}</p>
					<p>Afhaaluur:{{$dealKopen->afhaaluur}}</p>
					@if($dealKopen->afhalen == 1)
					<p>Ontvangst: Afhalen</p>
					<h3>Verkoper</h3>
					<span><img src="{{'/img/'.$dealKopen->afbeelding}}">{{link_to("users/$dealKopen->naam", $dealKopen->naam)}}</span>
					@else
					<p>Ontvangst: Komen Eten.</p>
					@endif
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