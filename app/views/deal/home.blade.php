@extends('layouts.logdIn')

@section('content')
	<div>
		<h1>Home</h1>
		{{Form::open(['url' => 'deals/getDealByRegion']) }}
		{{Form::select('regionId',$regions,$usersRegion)}}
		{{Form::submit('zoek')}}	
		{{Form::close() }}
		
		@if(empty($deals))
			<p>geen deals beschikbaar</p>
		@else
			<h1>beschikbare deals</h1>
			@foreach($deals as $deal)
				<div>
					<h2>
						{{$deal->gerecht}}
					</h2>
					<div><img src="{{'/img/deals/'.$deal->afbeeldingdeal}}"></div>
					
					<span><img src="{{'/img/'.$deal->afbeelding}}">{{link_to("users/$deal->naam", $deal->naam)}}
					</span>
					<p>Adres: {{$deal->straatnaam." ".$deal->huisnummer." ".$deal->postcode." ".$deal->gemeente}}
					@if($deal->postbus != "")
					Postbus:{{$deal->postbus}}
					@endif</p>
					@if($deal->afhalen == 1)
					<p>Ontvangst: Afhalen</p>
					@else
					<p>Ontvangst: Komen Eten.</p>
					@endif
					<p>Beschikbare Porties: {{$deal->porties}}</p>
					<p>Deal einde:{{$deal->dealeinde}}</p>
					<p>Afhaaluur:{{$deal->afhaaluur}}</p>

				</div>
			@endforeach
		@endif
	</div>
@stop