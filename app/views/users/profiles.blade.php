@extends('layouts.default')
@section("title")
	Zoek Deals | MealDeal
@stop

@section("content")
	<div>
		{{Form::open(['url' => 'user/filter' , 'method' => 'GET'])}}
		<input type="text" name='zoekString' placeholder="Zoeken mealdealers" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }"/>
		{{Form::close()}}
	</div>
	<h1>{{$title}}</h1>
	<div>
		@forelse($users as $user)
		      <a href="{{'/users/'.$user->naam}}">
				<h3>{{$user->naam}}</h3>
				<img src="{{strpos($user->afbeelding,'https') !== false ?$user->afbeelding : '/img/'.$user->afbeelding}}">
				<p>{{$user->badge}}</p>
				<p>aantal votes: {{$user->votes}}</p>			
			</a>
		@empty
		      <p>Geen mealdealers gevonden</p>
		@endforelse
		{{$users->appends(array('zoekString' => $zoekString))->links()}}
		
	</div>
@stop