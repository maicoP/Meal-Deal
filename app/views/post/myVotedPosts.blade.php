@extends('layouts.logdIn')

@section('content')
	<div>
		@if(empty($myVotedPosts))
			<p>No posts availebel</p>
		@else
			<h1>Posts You I voted on</h1>
			@foreach($myVotedPosts as $post)
				<div>
					<h2>
						{{link_to("posts/".$post->id,$post->title)}}
					</h2>
					<span>{{link_to("users/$post->userId", $post->username)}}</span>
					<p>Votes:{{$post->votes}}</p>
					{{link_to("$post->url", $post->url)}}

				</div>
			@endforeach
		@endif
	</div>
	
@stop