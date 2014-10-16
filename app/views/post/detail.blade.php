@extends('layouts.logdIn')

@section('content')
	<div>
			<h1>{{$post->title}}</h1>
			<span>{{link_to("users/$post->userId", $post->username)}}</span>
			<p>Votes:{{$post->votes}}</p>
			<p>{{$post->info}}</p>
			{{link_to("$post->url",$post->url)}}
			{{Form::open(['route' => array('votes.store')]) }}
			{{Form::hidden('postId',$post->id)}}
			{{Form::submit('upVote')}}
			{{Form::close() }}
	</div>
	<div>
		@if(empty($comments))
			<p>No votes have been placed</p>
		@else
			@foreach($comments as $comment)
				<span><img src="{{'/img/'.$comment->image}}"><p>{{link_to("users/$post->userId", $post->username)}} {{$comment->created_at}}</p></span>
				<p>{{$comment->comment}}</p>
			@endforeach
		@endif
		
	</div>
	<div>
		{{Form::open(['route' => array('comments.store')]) }}
		{{Form::hidden('postId',$post->id)}}
		{{Form::label('comment','Comment: ')}}
		<br/>
		{{Form::textarea('comment')}}
		<br/>
		{{Form::submit('verzend')}}
		{{Form::close() }}
	</div>
@stop