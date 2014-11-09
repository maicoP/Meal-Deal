@extends('layouts.default')
@section("title")
	Profielen | MealDeal
@stop

@section("content")
	<h1>{{$title}}</h1>
		{{Form::open(['url' => 'user/filter' , 'method' => 'GET'])}}
		<div class="searchbar">
			<input class="searchfield" type="text" name='zoekString' placeholder="Zoek naar mealdealers" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }"/>
		</div>
		{{Form::close()}}
	<div class="selectors">
			@forelse($users as $user)
			<div class="user">
		      	<a href="{{'/users/'.$user->naam}}">
					<div class="imgfbfix">
						<img src="{{strpos($user->afbeelding,'https') !== false ?$user->afbeelding : '/img/'.$user->afbeelding}}">
					</div>
				</a>
					<div class="badgetop"><img src="{{'/img/badges/'.$user->badge.'.png'}}" alt=""></div>
				<a href="{{'/users/'.$user->naam}}">
					<h3>{{$user->naam}}</h3>
				</a>
					<p><img src="{{'/css/img/thumbsup.png'}}" alt=""> {{$user->votes}}</p>			
			</div>
			@empty
			      <p>Geen mealdealers gevonden</p>
			@endforelse
			{{$users->appends(array('zoekString' => $zoekString))->links()}}
	</div>
@stop