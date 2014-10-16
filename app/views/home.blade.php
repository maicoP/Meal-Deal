@extends('layouts.default')

@section('content')
	<h1>Home</h1>

	<div>
		{{ Form::open(['route' => 'sessions.store']) }}
			<h3>Log in</h3>
			<div>
				{{ $errors->first('email')}}
				{{ $errors->first('password')}}
			</div>
			<div>
				{{ Form::label('email','Email:')}}
				{{ Form::email('email')}}
				
			</div>

			<div>
				{{ Form::label('password','Password:')}}
				{{ Form::password('password')}}
				
			</div>
			<div>
				{{ Form::submit('Login')}}
				{{link_to("users/create", "Register")}}
			</div>
		{{ Form::close() }}
		
	</div>
	<div>
		@if(empty($posts))
			<p>No posts availebel</p>
		@else
			<h1>Latest Posts</h1>
			@foreach($posts as $post)
				<div>
					<h2>
						{{$post->title}}
					</h2>
					<span>{{link_to("users/$post->userId", $post->username)}}</span>
					<p>Votes:{{$post->votes}}</p>
					{{link_to("$post->url", $post->url)}}

				</div>
			@endforeach
		@endif
	</div>
@stop