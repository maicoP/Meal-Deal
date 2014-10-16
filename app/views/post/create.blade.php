@extends('layouts.logdIn')

@section('content')
	<h1>Make Post</h1>
	{{Form::open(['route' => 'posts.store']) }}
		<div>
			<span>{{ $errors->first('title')}}</span>
			<span>{{ $errors->first('url')}}</span>
			<span>{{ $errors->first('info')}}</span>
		</div>
		<div>
			{{Form::label('title','Tile: ')}}
			{{Form::text('title')}}	
		</div>
		<div>
			{{Form::label('url','Url: ')}}
			{{Form::text('url')}}	
		</div>
		<div>
			{{Form::label('info','Info: ')}}
			<br/>
			{{Form::textarea('info')}}	
		</div>
		<div>{{Form::submit('Post')}}</div>
	{{Form::close() }}
@stop