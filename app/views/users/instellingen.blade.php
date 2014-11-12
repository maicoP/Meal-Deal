@extends('layouts.default')
@section("title")
	Instellingen | MealDeal
@stop

@section("content")
	<h1>Instellingen</h1>
	<div class="instellingen">
		<div class="regioselect instellinglink">
		{{Link_to("users/".$userData->naam."/edit","PROFIEL BEWERKEN")}}
		</div>
		<div class="methodeselect instellinglink">
		{{Link_to("user/editPassword","WACHTWOORD WIJZIGEN")}}
		</div>
	</div>
	<div>
		<h2>Profiel van {{$userData->naam}}</h2>
		<div class="profielbox userprofile">
		<div class="userprofile-left">
			<img src="{{strpos($userData->afbeelding,'https') !== false ?$userData->afbeelding : '/img/'.$userData->afbeelding}}">
		</div>
		<div class="userprofile-right">
			<div id="badgeleft">
				<img src="{{'/img/badges/'.$userData->badge.'.png'}}" alt="">
			</div>
			<div id="badgeright">
				Deals gedoneerd: {{$dealsVerkocht}} <br>
				Deals geclaimd: {{$dealsGekocht}}
			</div>
			<div id="useritem">
				<img src="{{'/css/img/home.png'}}" alt=""><br>
				{{$userData->straatnaam." ".$userData->huisnummer."<br>".$userData->postcode." ".$userData->gemeente}}
				@if($userData->postbus != "")
				<br>Postbus:{{$userData->postbus}}
				@endif
			</div>
			<div id="useritem">
				<img src="{{'/css/img/uni.png'}}" alt="">
				<br>{{$userData->school->naam}}
			</div>
			<div id="useritem">
				<img src="{{'/css/img/info.png'}}" alt="">
				{{$userData->info}}
			</div>
			<div id="useritem">
				<img src="{{'/css/img/votes.png'}}" alt="">{{$userData->votes}}
			</div>
		</div>
		</div>

	</div>
	<div>
		@forelse($userDeals as $deal )

			<div class="deal dealuser">
				<div class="deal-info">
						<div class="deal-information">
						<div class="deal-title">{{$deal->gerecht}}</div>
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
					@if($deal->beschikbaar == 1)
					<p>Beschikbaar</p>
					@else
					<p>Niet meer Beschikbaar</p>
					@endif
				</div>
				<div class="deal-photo">
					<img src="{{'/img/deals/'.$deal->afbeeldingdeal}}">
				</div>
			</div>

		@empty
			<h2>Deze gebruiker heeft nog geen deals geplaatst.</h2>
		@endforelse
		{{$userDeals->links()}}
	</div>
	

@stop