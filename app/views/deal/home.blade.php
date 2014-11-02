@extends('layouts.logdIn')

@section('content')
	<div>
		<h1>Home</h1>
		<div>
			<h3>Welcome {{Auth::user()->naam}}</h3>
			<img src="{{'/img/'.Auth::user()->afbeelding}}">
			<p>Aantal Coins :{{Auth::user()->coins}}</p>
		@if(Session::get('error') !== null )
		<p>{{Session::get('error')}}</p>
		@endif
		</div>
		<h1>beschikbare deals</h1>
		{{Form::open(['url' => 'deals/filter','method'=> 'post']) }}
		<select name='regionId' onchange="this.form.submit()">
			@foreach($regions as $key => $value)
				@if($key == $selectedRegion)
					<option value="{{$key}}" selected="selected">{{$value}}</option>
				@else
					<option value="{{$key}}">{{$value}}</option>
				@endif
		    @endforeach
		</select>
		<select name='afhalen' onchange="this.form.submit()">
				@if($selectedAfhaalMethode == 1)
					<option value="2">Alle</option>
					<option value="1" selected="selected">Afhalen</option>
					<option value="0">Komen Eten</option>
				@elseif($selectedAfhaalMethode == 0)
					<option value="2">Alle</option>
					<option value="1">Afhalen</option>
					<option value="0" selected="selected">Komen Eten</option>
				@else
					<option value="2" selected="selected">Alle</option>
					<option value="1">Afhalen</option>
					<option value="0">Komen Eten</option>
				@endif
					
		</select>
		{{Form::close() }}
		
		@if(empty($deals))
			<p>geen deals beschikbaar</p>
		@else
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
					{{Form::open(['route' => 'mydeals.store'])}}
					{{Form::hidden('dealId',$deal->id)}}
					{{Form::submit('Deal')}}
					{{Form::close()}}

				</div>
			@endforeach
		@endif
	</div>
@stop