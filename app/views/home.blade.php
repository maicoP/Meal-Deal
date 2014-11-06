<!DOCTYPE html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Meal Deal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="MealDeal - Students cooking for students" />
        <meta name="keywords" content="mealdeal, students, meals, deals" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        {{ HTML::style('css/home/reset.css'); }}
        {{ HTML::style('css/home/style.css'); }}
        {{ HTML::style('css/home/font-awesome-4.2.0/css/font-awesome.min.css'); }}
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $(".to_register").click(function() {
                    $("#register").fadeIn(1000); 
                    $("#login").fadeOut(1000);
                    $("#register").css("display","inline"); 
                    $("#login").css("display","none"); 
                    $("#wrapper").css("margin-bottom","900px"); 
                }); 
                $(".to_login").click(function() {
                    $("#register").fadeOut(1000); 
                    $("#login").fadeIn(1000);
                    $("#register").css("display","none"); 
                    $("#login").css("display","inline"); 
                    $("#wrapper").css("margin-bottom","0px"); 
                }); 
            }); 
        </script>
    </head>
    <body>
            <div id="logo">
            	{{ HTML::image('css/home/logo.png'); }}
            </div>
            <div id="wrapper">

                @if($errors->isEmpty())
                    @if(Session::has('fbData'))
                       <div id="login" class="animate form" style="display: none;"> 
                    @else
                        <div id="login" class="animate form" style="display: inline;">
                    @endif
                @else
                    <div id="login" class="animate form" style="display: none;">
                @endif
                @if(Session::has('message'))
                    {{ Session::get('message')}}
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
    </body>
</html>
