@extends('layouts.default')
@section("title")
	Zoek Deals | MealDeal
@stop

@section("content")
	<h1>Profiel Wijzigen</h1>
	<div>
		{{Link_to("#","Profiel wijzigen")}}
		{{Link_to("user/editPassword","Wachtwoord wijzigen")}}
	</div>
	<div>
		<h2>Profile of {{$userData->naam}}</h2>
		{{Form::open(['url' => 'users/'.$userData->id,'files' => true,'method' => 'PUT'])}}
	   	<p>
	   	    Afbeelding: <br/>	
	   		<img src="{{strpos($userData->afbeelding,'https') !== false ?$userData->afbeelding : '/img/'.$userData->afbeelding}}">
	   	    <span>{{ $errors->first('afbeelding')}}</span>
	   	    {{Form::file('afbeelding','',array('value' => 'Avatar'))}}    
	   	</p>  
	   	<p> 
	   	    <span>{{ $errors->first('email')}}</span>
	   	    Email: 
	   	    {{Form::email('email',$userData->email, array('type' => 'email','required' => 'required'))}}
	   	</p>
	   	<p> 
	   	    School: 
	   	    {{Form::select('schoolId', $schools,$userData->schoolId)}}  
	   	</p>
	   	<p> 
	   	    Regio: 
	   	    {{Form::select('regionId', $regions,$userData->regionId)}}  
	   	</p>
	   	<p> 
	   	    Straatnaam: 
	   	    {{Form::text('straatnaam',$userData->straatnaam,array('required' => 'required'))}}   
	   	</p>
	   	<p> 
	   	    Postcode: 
	   	    {{Form::text('postcode',$userData->postcode,array('required' => 'required'))}}   
	   	</p>
	   	<p> 
	   	    Gemeente: 
	   	    {{Form::text('gemeente',$userData->gemeente,array('required' => 'required'))}}       
	   	</p>
	   	<p> 
	   	    Huisnummer: 
	   	    {{Form::text('huisnummer',$userData->huisnummer,array('required' => 'required'))}}       
	   	</p>
	   	<p> 
	   	    Postbus: 
	   	    {{Form::text('postbus',$userData->postbus)}}  
	   	</p>
	   	<p class="textarea"> 
	   	    {{Form::label('info',' ', array('data-icon' => '&#xf05a;'))}}
	   	    {{Form::textarea('info',$userData->info,array('required' => 'required','rows' => '4'))}}        
	   	</p>
	
		{{Form::submit('Wijzigen')}}
		{{Form::close()}}
	</div>
@stop