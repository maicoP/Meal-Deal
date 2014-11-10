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
						<img width="100" height="100" src="{{strpos($user->afbeelding,'https') !== false ?$user->afbeelding : '/img/'.$user->afbeelding}}">
					</div>
				</a>
					<div class="badgetop"><img src="{{'/img/badges/'.$user->badge.'.png'}}" alt=""></div>
				<a class="username" href="{{'/users/'.$user->naam}}">
					<h4>{{$user->naam}}</h4>
				</a>
					<div class="username"><img src="{{'/css/img/thumbsup.png'}}" alt=""> {{$user->votes}}</div>			
			</div>
			@empty
			      <p>Geen mealdealers gevonden</p>
			@endforelse
			{{$users->appends(array('zoekString' => $zoekString))->links()}}
	</div>
@stop