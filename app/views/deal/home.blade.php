@extends('layouts.default')
@section("title")
	Zoek Deals | MealDeal
@stop

@section("content")
	<div>
		<div>
			<h3>Welcome {{Auth::user()->naam}}</h3>
			<img src="{{strpos(Auth::user()->afbeelding,'https') !== false ?Auth::user()->afbeelding : '/img/'.Auth::user()->afbeelding}}">
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
			@forelse($deals as $deal)
				<div>
					<h2>
						{{$deal->gerecht}}
					</h2>
					<div><img src="{{'/img/deals/'.$deal->afbeeldingdeal}}"></div>
					
					<span><img src="{{strpos($deal->afbeelding,'https') !== false ?$deal->afbeelding : '/img/'.$deal->afbeelding}}">{{link_to("users/$deal->naam", $deal->naam)}}
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
		@empty
		      <p>Geen Deals gevonden</p>
		@endforelse
		{{$deals->links()}}
	</div>
@stop