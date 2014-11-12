@extends('layouts.default')
@section("title")
	Profiel | MealDeal
@stop

@section("content")
	<div>
		<h1>Profiel van {{$user->naam}}</h1>

		<div class="profielbox userprofile">
		<div class="userprofile-left">
			<img src="{{strpos($user->afbeelding,'https') !== false ?$user->afbeelding : '/img/'.$user->afbeelding}}">
		</div>
		<div class="userprofile-right">
			<div id="badgeleft">
				<img src="{{'/img/badges/'.$user->badge.'.png'}}" alt="">
			</div>
			<div id="badgeright">
				Deals gedoneerd: {{$dealsVerkocht}} <br>
				Deals geclaimd: {{$dealsGekocht}}
			</div>
			<div id="useritem">
				<img src="{{'/css/img/home.png'}}" alt=""><br>
				{{$user->straatnaam." ".$user->huisnummer."<br>".$user->postcode." ".$user->gemeente}}
				@if($user->postbus != "")
				<br>Postbus:{{$user->postbus}}
				@endif
			</div>
			<div id="useritem">
				<img src="{{'/css/img/uni.png'}}" alt="">
				<br>{{$user->school->naam}}
			</div>
			<div id="useritem">
				<img src="{{'/css/img/info.png'}}" alt="">
				{{$user->info}}
			</div>
			<div id="useritem">
				<img src="{{'/css/img/votes.png'}}" alt="">{{$user->votes}}
				@if(!in_array ( $user->id , $userVotedOn))
				<div class="voteuserprofile">
					{{Form::open(['url' => 'user/'.$user->id.'/vote'])}}
					{{Form::submit('STEM', ['class' => 'dealbutton','value' => 'DEAL'])}}
					{{Form::close()}}
				</div>
			@endif
			</div>
		</div>
		</div>

		<h2>Deals van {{$user->naam}}</h2>
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

					@if($deal->beschikbaar == 1 && $deal->dealeinde > date('Y-m-d H:i:s'))
					{{Form::open(['route' => 'mydeals.store'])}}
					{{Form::hidden('dealId',$deal->id)}}
					{{Form::submit('DEAL', ['class' => 'dealbutton','value' => 'DEAL'])}}
					{{Form::close()}}
					@else
					<p>Niet meer Beschikbaar</p>
					@endif
				</div>
				<div class="deal-photo">
					<img src="{{'/img/deals/'.$deal->afbeeldingdeal}}">
				</div>
			</div>
		@empty
			<p>{{$user->naam}} heeft nog geen deals geplaats</p>
		@endforelse
		{{$userDeals->links()}}
		
	</div>
	
@stop