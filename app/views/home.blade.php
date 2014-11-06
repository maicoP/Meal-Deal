@extends('layouts.default')
@section('content')
            <div id="logo">
            	{{ HTML::image('css/home/logo.png'); }}
            </div>
            <div id="wrapper">
                @if(Session::has('message'))
                    {{ Session::get('message')}}
                @endif
                @if($errors->isEmpty())
                    @if(Session::has('fbData'))
                       <div id="login" class="animate form" style="display: none;"> 
                    @else
                        <div id="login" class="animate form" style="display: inline;">
                    @endif
                @else
                    <div id="login" class="animate form" style="display: none;">
                @endif
                    {{ Form::open(['route' => 'sessions.store']) }}
                        <h1>Log in</h1> 
                        @if(Session::get('err') !== null)
                        <span>{{ Session::get('err') }}</span>
                        @endif
                        <p> 
                            {{Form::label('email', ' ', array('data-icon' => '&#xf003;'))}}
							{{Form::email('email','', array('placeholder' => 'Email','required' => 'required'))}}
                        </p>
                        <p> 
							{{Form::label('password',' ', array('data-icon' => '&#xf084;'))}} 
							{{ Form::password('password', ['placeholder' => 'Paswoord','type' => 'password','required','min' => '8']) }}                   

                        </p>
                        <p class="login button"> 
                        	{{ Form::submit('LOG IN', ['class' => 'inloggen','value' => 'LOGIN'])}}
						</p>
                        <p class="login button"> 
                            <a class="fb" href="login/fb">LOG IN MET FACEBOOK</a> 
                            
						</p>
                        <p class="change_link">
							Nog geen lid?
							<a href="#" class="to_register">Registreer</a>
						</p>
                    {{ Form::close() }}
                </div>
                @if($errors->isEmpty())
                    @if(Session::has('fbData'))
                       <div id="login" class="animate form" style="display: inline;">
                    @else
                    <div id="register" class="animate form" style="display: none;">
                    @endif
                @else
                    <div id="register" class="animate form" style="display: inline;">
                @endif
                    {{Form::open(['route' => 'users.store','files' => true]) }}
                        <h1>Registreer</h1> 
                        @if(Session::has('fbData'))
                        {{Form::hidden('facebook',true)}}
                        {{Form::hidden('uid',Session::get('fbData')['uid'])}}
                        @else
                            {{Form::hidden('facebook',false)}}
                        @endif
                        <p> 
                            <span>{{ $errors->first('naam')}}</span>
                            {{Form::label('naam',' ', array('data-icon' => '&#xf007;'))}}
                            {{Form::text('naam',Session::has('fbData') ? Session::get('fbData')['name'] :'', array('placeholder' => 'Gebruikersnaam','required' => 'required'))}}
                        </p>
                        <p> 
                            <span>{{ $errors->first('email')}}</span>
                            {{Form::label('email',' ', array('data-icon' => '&#xf003;'))}}
                            {{Form::email('email',Session::has('fbData') ? Session::get('fbData')['email'] :'', array('placeholder' => 'Email','type' => 'email','required' => 'required'))}}
                        </p>
                        <p> 
                            <span>{{ $errors->first('password')}}</span>
                            {{Form::label('password',' ', array('data-icon' => '&#xf084;'))}}
                            {{Form::password('password', array('placeholder' => 'Paswoord','type' => 'password','required' => 'required'))}}    
                        </p>
                        <p> 
                            {{Form::label('regionId','Regio: ')}}
                            {{Form::select('regionId', $regions)}}  
                        </p>
                        <p> 
                            {{Form::label('straatnaam',' ', array('data-icon' => '&#xf041;'))}}
                            {{Form::text('straatnaam','',array('placeholder' => 'Straatnaam','required' => 'required'))}}   
                        </p>
                        <p> 
                            {{Form::label('postcode',' ', array('data-icon' => '&#xf041;'))}}
                            {{Form::text('postcode','',array('placeholder' => 'Postcode','required' => 'required'))}}   
                        </p>
                        <p> 
                            {{Form::label('gemeente',' ', array('data-icon' => '&#xf041;'))}}
                            {{Form::text('gemeente','',array('placeholder' => 'Gemeente','required' => 'required'))}}       
                        </p>
                        <p> 
                            {{Form::label('huisnummer',' ', array('data-icon' => '&#xf041;'))}}
                            {{Form::text('huisnummer','',array('placeholder' => 'Huisnummer','required' => 'required'))}}       
                        </p>
                        <p> 
                            {{Form::label('postbus',' ', array('data-icon' => '&#xf041;'))}}
                            {{Form::text('postbus','',array('placeholder' => 'Postbus'))}}  
                        </p>
                        <p class="textarea"> 
                            {{Form::label('info',' ', array('data-icon' => '&#xf05a;'))}}
                            {{Form::textarea('info','',array('placeholder' => 'Informatie','required' => 'required','rows' => '4'))}}        
                        </p>
                        <p> 
                            <span>{{ $errors->first('afbeelding')}}</span>
                            {{Form::label('afbeelding',' ',array('data-icon' => '&#xf030;'))}}
                            {{Form::file('afbeelding','',array('placeholder' => 'Avatar'))}}    
                        </p>                                                                                              
                        <p class="signin button"> 
                            <input type="submit" class="inloggen" value="Registreren"/> 
                        </p>
                        <p class="change_link">  
                            Al wel lid?
                            @if(Session::has('fbData'))
                               <a href="/" class="to_login">Log in</a>
                            @else
                                <a href="#" class="to_login">Log in</a>
                            @endif
                        </p>
                    {{Form::close() }}
                </div>
            </div>
@stop
