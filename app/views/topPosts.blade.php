@extends('layouts.default')

@section('content')
	<div>
		@if(empty($posts))
			<p>No posts availebel</p>
		@else
			<h1>Top 10 Posts</h1>
			@foreach($posts as $post)
				<div>
					<h2>
						{{$post->title}}
					</h2>
					<span><img src="public/img/{{$post->image}}">{{link_to("users/$post->userId", $post->username)}}</span>
					<p>{{$post->created_at}} Votes:{{$post->votes}}</p>
					<p>{{$post->info}}</p>
					{{link_to("$post->url", $post->url)}}
				</div>
			@endforeach
		@endif
	</div>
	
@stop