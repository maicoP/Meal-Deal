@extends('layouts.logdIn')

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
					<span>{{link_to("users/$post->userId", $post->username)}}</span>
					<p>Votes:{{$post->votes}}</p>
					{{link_to("$post->url", $post->url)}}
					{{Form::open(['route' => array('votes.store')]) }}
					{{Form::hidden('postId',$post->id)}}
					{{Form::submit('upVote')}}
					{{Form::close() }}

				</div>
			@endforeach
		@endif
	</div>
	
@stop