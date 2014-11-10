@extends('layouts.default')
@section("title")
	Zoek Deals | MealDeal
@stop

@section("content")
	<div>
		<div>
		<!--<h3>Welkom {{Auth::user()->naam}}</h3>
		<img src="{{strpos(Auth::user()->afbeelding,'https') !== false ?Auth::user()->afbeelding : '/img/'.Auth::user()->afbeelding}}">
		<p>Aantal Coins :{{Auth::user()->coins}}</p> -->
		@if(Session::get('error') !== null )
		<p>{{Session::get('error')}}</p>
		@endif
		</div>
		<h1>Beschikbare deals</h1>
		{{Session::has('zoekString')}}
			{{Form::open(['url' => 'deals/filter','method'=> 'post']) }}
		<div class="searchbar">
			<input class="searchfield" type="text" name='zoekString' value="{{$zoekString}}"placeholder="Zoek naar deals" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }"/>
		</div>
		<div class="selectors">
			<div class="regioselect">
			<span class="custom-dropdown fixdev">
			<select class="custom-dropdown__select" name='regionId' onchange="this.form.submit()">
				@foreach($regions as $key => $value)
					@if($key == $selectedRegion)
						<option value="{{$key}}" selected="selected">{{$value}}</option>
					@else
						<option value="{{$key}}">{{$value}}</option>
					@endif
			    @endforeach
			</select>
			</div>
			</span>
			<div class="methodeselect">
			<span class="custom-dropdown fixdev">
			<select class="custom-dropdown__select" name='afhalen' onchange="this.form.submit()">
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
			</span>
			</div>
			{{Form::close() }}
		</div>
			@forelse($deals as $deal)
				<div class="deal">
					<div class="deal-owner">
						<img class="owner-avatar" src="{{strpos($deal->afbeelding,'https') !== false ?$deal->afbeelding : '/img/'.$deal->afbeelding}}" alt="">
						<img src="{{'/img/badges/'.$deal->badge.'.png'}}" alt="">
						<div class="owner-name">{{link_to("users/$deal->naam", $deal->naam)}}</div>
						<div class="owner-address">{{$deal->straatnaam." ".$deal->huisnummer."<br>".$deal->postcode." ".$deal->gemeente}}
						@if($deal->postbus != "")
						<br>Postbus: {{$deal->postbus}}
						@endif
						</div>
					</div>
					<div class="deal-info">
						<div class="deal-title">{{$deal->gerecht}}</div>
						<div class="deal-information">
						<p>{{$deal->beschrijving}}</p>
						@if($deal->afhalen == 1)
							Ontvangst: Afhalen
						@else
							Ontvangst: Komen Eten
						@endif
						</div>
						<div class="deal-practical">
							<div class="practical"><img src="{{'/css/img/klok.png'}}" alt=""></div>
							<div class="practicaltext">Deal Einde<br><b><p class="fix">{{substr($deal->dealeinde,11,5)}}</p></b></div>
							<div class="practical"><img src="{{'/css/img/vork.png'}}" alt=""></div>
							<div class="practicaltext">Eten Om<br><b><p class="fix">{{substr($deal->afhaaluur,11,5)}}</p></b></div>
							<div class="practical"><img src="{{'/css/img/people.png'}}" alt=""></div>
							<div class="practicaltext">Deals<br><b>{{$deal->porties}}</b></div>
						</div>
						{{Form::open(['route' => 'mydeals.store'])}}
						{{Form::hidden('dealId',$deal->id)}}
						{{Form::submit('DEAL', ['class' => 'dealbutton','value' => 'DEAL'])}}
						{{Form::close()}}
					</div>
					<div class="deal-photo"><img src="{{'/img/deals/'.$deal->afbeeldingdeal}}" alt=""></div>
				</div>
		@empty
		      <h2>Sorry! Geen deals beschikbaar. <br>Probeer het straks nog eens!</p>
		@endforelse
		{{$deals->links()}}
	</div>
@stop