@extends('layouts.default')

@section('content')
	<div>
		<h1>Profile of {{$user->username}}</h1>
		<img src="{{'/img/'.$user->image}}">
		<p>{{$user->info}}</p>
		<h2>Posts from {{$user->username}}</h2>
		@foreach($posts as $post )
			<div>
					<h3>
						{{link_to("posts/".$post->id,$post->title)}}
					</h3>
					<span>{{$post->username}}</span>
					<p>{{$post->created_at}} Votes:{{$post->votes}}</p>
					<p>{{$post->info}}</p>
					{{link_to("$post->url", $post->url)}}

				</div>
		@endforeach
	</div>
	
@stop