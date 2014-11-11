@extends('layouts.default')
@section("title")
	Mijn Deals | MealDeal
@stop

@section("content")
	<div>
		<h1>Mijn Deals</h1>
		<h2>Deals die u weggeeft</h2>
		<div>
				@if($VerkopenAangevraagt->isEmpty() && $VerkopenGeaccepteert->isEmpty() && $dealsBeschikbaar->isEmpty())
				<div class="mijndeal lastdealbox">
					<h3>U hebt momenteel geen deals die u weggeeft.</h3>
					<div class="small">Deals kan u {{link_to("deals/create", "hier")}} aanmaken.</div>
				</div>
				@else
					@if(!$VerkopenAangevraagt->isEmpty())
						<h2 class="sub">Aanvragen</h2>
						@foreach($VerkopenAangevraagt as $dealVerkopen)
							<div class="mijndeal">
								<h3><div class="link">{{link_to("users/".$dealVerkopen->koper->naam, $dealVerkopen->koper->naam)}}</div> wil graag een portie van: {{$dealVerkopen->deal->gerecht}}<br>
								</h3>
								<div class="small">
									Deal einde: {{substr($dealVerkopen->deal->dealeinde,11,5)}}, Afhaaluur: {{substr($dealVerkopen->deal->afhaaluur,11,5)}}, 
									@if($dealVerkopen->deal->afhalen == 1)
									Ontvangst: Afhalen
									@else
									Ontvangst: Komen Eten.
									@endif
								</div>
							</div>
							<div class="mijndeal-button">
								{{Form::open(['url' => 'mydeals/'.$dealVerkopen->id.'/edit','method' => 'get'])}}
								{{Form::hidden('type','accepteer')}}
								{{Form::submit('ACCEPTEER DEAL', ['class' => 'dealbutton dealbutton-left'])}}
								{{Form::close()}}
								{{Form::open(['url' => 'mydeals/'.$dealVerkopen->id.'/edit','method' => 'get'])}}
								{{Form::hidden('type','wijger')}}
								{{Form::submit('WIJGER DEAL', ['class' => 'dealbutton dealbutton-right'])}}
								{{Form::close()}}
							</div>
						@endforeach
						{{$VerkopenAangevraagt->links()}}
					@endif
					@if(!$VerkopenGeaccepteert->isEmpty())
						<h2 class="sub">Geaccepteert</h2>
						@foreach($VerkopenGeaccepteert as $dealVerkopen)
							<div class="mijndeal">
								<h3>U geeft een portie weg van {{$dealVerkopen->deal->gerecht}} aan {{link_to("users/".$dealVerkopen->koper->naam, $dealVerkopen->koper->naam)}}</h3>
							<div class="small">	
								@if($dealVerkopen->deal->afhalen == 1)
								Afhaaluur: 
								@else
								Komen eten om: 
								@endif
								{{substr($dealVerkopen->deal->afhaaluur,11,5)}}</p>
							</div>
							</div>
							<div class="mijndeal-button">								
								{{Form::open(['url' => 'mydeals/'.$dealVerkopen->id.'/edit','method' => 'get'])}}
								{{Form::hidden('type','afzeggen')}}
								{{Form::submit('DEAL AFZEGGEN', ['class' => 'dealbutton'])}}
								{{Form::close()}}	
							</div>
						@endforeach
						{{$VerkopenGeaccepteert->links()}}
					@endif
					
					@if(!$dealsBeschikbaar->isEmpty())
						<h2 class="sub">Beschikbaar</h2>
						@foreach($dealsBeschikbaar as $dealBeschikbaar)
							<div class="mijndeal">
								<h3>{{$dealBeschikbaar->deal->gerecht}}</h3>
								<div class="small">Deal einde:{{substr($dealBeschikbaar->deal->dealeinde,11,5)}}, Afhaaluur:{{substr($dealBeschikbaar->deal->afhaaluur,11,5)}}
								@if($dealBeschikbaar->deal->afhalen == 1)
								<p>Ontvangst: Afhalen</p>
								@else
								<p>Ontvangst: Komen Eten.</p>
								@endif
								</div>
							</div>
						@endforeach
						{{$dealsBeschikbaar ->links()}}
					@endif
				@endif
		</div>
		<div>
			<h2>Aangevraagde deals</h2>
				@forelse($dealsKopen as $dealKopen)
				<div class="mijndeal">
					<h3>
						{{$dealKopen->deal->gerecht}} van 
						{{link_to("users/".$dealKopen->verkoper->naam, $dealKopen->verkoper->naam)}} om 
						{{substr($dealKopen->deal->afhaaluur,11,5)}}
					</h3>
					<div class="small">
							@if($dealKopen->deal->afhalen == 1)
							Af te halen: 
							@else
							Komen eten: 
							@endif
						{{$dealKopen->verkoper->straatnaam." ".$dealKopen->verkoper->huisnummer.", ".$dealKopen->verkoper->postcode." ".$dealKopen->verkoper->gemeente}}, 
						@if($dealKopen->verkoper->postbus != "")
						Postbus: {{$dealKopen->verkoper->postbus}}
						
						@endif
					<br>
					<!-- Extra info: {{$dealKopen->deal->beschrijving}}  -->
					</div>
				</div>
				</div>
				<div class="mijndeal-button">
					@if($dealKopen->status == "aangevraagt")
						{{Form::open(['url' => 'mydeals/'.$dealKopen->id.'/edit','method' => 'get'])}}
						{{Form::hidden('type','aanvraag intrekken')}}
						{{Form::submit('AANVRAAG INTREKKEN', ['class' => 'dealbutton','value' => 'AANVRAAG INTREKKEN'])}}
						{{Form::close()}}
						<h3 class="status">Status: <div class="color">Wachten op reactie van verkoper</div></h3>
					@elseif($dealKopen->status == "geaccepteert")
						{{Form::open(['url' => 'mydeals/'.$dealKopen->id.'/edit','method' => 'get'])}}
						{{Form::hidden('type','Acceptatieafzeggen')}}
						{{Form::submit('DEAL AFZEGGEN', ['class' => 'dealbutton','value' => 'DEAL AFZEGGEN'])}}
						{{Form::close()}}
						<h3 class="status">Status: <div class="color">Deal is geaccepteert</div></h3>
					@endif
				</div>
				@empty
				<div class="mijndeal lastdealbox">
					<h3>U hebt momenteel nog geen deals aangevraagd.</h3>
					<div class="small">Deals kan u {{link_to("deals", "hier")}} vinden.</div>
				</div>
				@endforelse
				{{$dealsKopen->links()}}
		</div>
		
	</div>
@stop