@extends('layouts.default')
@section("title")
	Profiel Bewerken | MealDeal
@stop

@section("content")
	<h1>Profiel Wijzigen</h1>
	<div>
		<h2>{{$userData->naam}}</h2>
		<div class="selectors">
		<div class="submitdeal">
		{{Form::open(['url' => 'users/'.$userData->id,'files' => true,'method' => 'PUT'])}}
	   	<p class="userafbeelding">
	   	    {{Form::label('afbeelding','Afbeelding', array('data-icon' => '&#xf030;'))}}<br>
	   		<img src="{{strpos($userData->afbeelding,'https') !== false ?$userData->afbeelding : '/img/'.$userData->afbeelding}}">
	   	    <span>{{ $errors->first('afbeelding')}}</span>
	   	    {{Form::file('afbeelding','',array('value' => 'Avatar'))}}    
	   	</p>  
	   	<p> 
	   	    <span>{{ $errors->first('email')}}</span>
	   	    {{Form::label('email','Email', array('data-icon' => '&#xf1fa;'))}}
	   	    {{Form::email('email',$userData->email, array('type' => 'email','required' => 'required'))}}
	   	</p>
	

	   	<p> 
	   	    {{Form::label('school','School')}}
	   	    <span class="ccustom-dropdown cfixdev cwidthfix3">
	   	    {{Form::select('schoolId', $schools,$userData->schoolId, array('class' => 'ccustom-dropdown__select'))}}
	   	    </span>
	   	</p>
	   	<p> 
	   	    {{Form::label('regio','Regio')}}
	   	    <span class="ccustom-dropdown cfixdev cwidthfix3">
	   	    {{Form::select('regionId', $regions,$userData->regionId, array('class' => 'ccustom-dropdown__select'))}} 
	   	    </span>
	   	</p>
	   	<p> 
	   	    {{Form::label('straatnaam','Straatnaam', array('data-icon' => '&#xf018;'))}}
	   	    {{Form::text('straatnaam',$userData->straatnaam,array('required' => 'required'))}}   
	   	</p>
	   	<p> 
	   	    {{Form::label('postcode','Postcode', array('data-icon' => '&#xf162;'))}}
	   	    {{Form::text('postcode',$userData->postcode,array('required' => 'required'))}}   
	   	</p>
	   	<p> 
	   	    {{Form::label('gemeente','Gemeente', array('data-icon' => '&#xf041;'))}}
	   	    {{Form::text('gemeente',$userData->gemeente,array('required' => 'required'))}}       
	   	</p>
	   	<p> 
	   	    {{Form::label('huisnummer','Huisnummer', array('data-icon' => '&#xf015;'))}}
	   	    {{Form::text('huisnummer',$userData->huisnummer,array('required' => 'required'))}}       
	   	</p>
	   	<p> 
	   	    {{Form::label('postbus','Postbus', array('data-icon' => '&#xf0e0;'))}}
	   	    {{Form::text('postbus',$userData->postbus)}}  
	   	</p>
	   	<p>
	   	    {{Form::label('info','Info', array('data-icon' => '&#xf05a;'))}}
	   	    {{Form::textarea('info',$userData->info,array('required' => 'required','rows' => '4'))}}        
	   	</p>
	
		{{Form::submit('Wijzigen', ['class' => 'inloggen','value' => 'WIJZIGEN'])}}
		{{Form::close()}}
		</div>
		</div>
	</div>
@stop