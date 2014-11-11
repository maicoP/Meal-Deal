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
        {{ HTML::style('css/shared.css'); }}
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
    <div id="mainwrapper">
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
                    {{ Form::open(['route' => 'sessions.store']) }}
                        <h1>Log in</h1> 
                        @if(Session::has('message'))
                            <div class="regsucc">{{ Session::get('message')}}</div>
                        @endif
                        @if(Session::get('err') !== null)
                        <div class="regerror">{{ Session::get('err') }}</div>
                        @endif
                        <p> 
                            {{Form::label('email', ' ', array('data-icon' => '&#xf1fa;'))}}
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
                            <a class="fb" href="login/fb">
                            <input class="fb" value="LOG IN MET FACEBOOK" type="button">
                            </a> 
						</p>
                        <p class="change_link">
							Nog geen lid?
							<a href="#" class="to_register">Registreer</a>                            
						</p>
                    {{ Form::close() }}               
                    <div class="info"><a class="hovera" href="#openModal">Meal Deal? </a> -<a class="hovera" href="#openModal2"> Werking</a></div>
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
                        <div class="regerror">{{ $errors->first('naam')}}</div>
                        <div class="regerror">{{ $errors->first('email')}}</div>
                        <div class="regerror">{{ $errors->first('password')}}</div>
                        <div class="regerror">{{ $errors->first('afbeelding')}}</div>
                        @if(Session::has('fbData'))
                        {{Form::hidden('facebook',true)}}
                        @else
                            {{Form::hidden('facebook',false)}}
                        @endif
                        <p> 
                            {{Form::label('naam',' ', array('data-icon' => '&#xf19d;'))}}
                            {{Form::text('naam',Session::has('fbData') ? Session::get('fbData')['name'] :'', array('placeholder' => 'Gebruikersnaam','required' => 'required'))}}
                        </p>
                        <p> 
                            {{Form::label('email',' ', array('data-icon' => '&#xf1fa;'))}}
                            {{Form::email('email',Session::has('fbData') ? Session::get('fbData')['email'] :'', array('placeholder' => 'Email','type' => 'email','required' => 'required'))}}
                        </p>
                        <p> 
                            {{Form::label('password',' ', array('data-icon' => '&#xf084;'))}}
                            {{Form::password('password', array('placeholder' => 'Paswoord','type' => 'password','required' => 'required'))}}    
                        </p>
                        <p>{{Form::label('schoolId','School: ')}}
                            <span class="ccustom-dropdown cfixdev">
                            {{Form::select('schoolId', $schools, null,array('class' => 'ccustom-dropdown__select'))}}
                            </span>
                        </p>
                        <p>{{Form::label('regionId','Regio: ')}}
                            <span class="ccustom-dropdown cfixdev">
                            {{Form::select('regionId', $regions, null,array('class' => 'ccustom-dropdown__select'))}}
                            </span>
                        </p>
                        <p> 
                            {{Form::label('gemeente',' ', array('data-icon' => '&#xf041;'))}}
                            {{Form::text('gemeente','',array('placeholder' => 'Gemeente','required' => 'required'))}}       
                        </p>
                        <p> 
                            {{Form::label('postcode',' ', array('data-icon' => '&#xf162;'))}}
                            {{Form::text('postcode','',array('placeholder' => 'Postcode','required' => 'required'))}}   
                        </p>
                        <p> 
                            {{Form::label('straatnaam',' ', array('data-icon' => '&#xf018;'))}}
                            {{Form::text('straatnaam','',array('placeholder' => 'Straatnaam','required' => 'required'))}}   
                        </p>
                        <p> 
                            {{Form::label('huisnummer',' ', array('data-icon' => '&#xf015;'))}}
                            {{Form::text('huisnummer','',array('placeholder' => 'Huisnummer','required' => 'required'))}}       
                        </p>
                        <p> 
                            {{Form::label('postbus',' ', array('data-icon' => '&#xf0e0;'))}}
                            {{Form::text('postbus','',array('placeholder' => 'Postbus'))}}  
                        </p>
                        <p class="textarea"> 
                            {{Form::label('info',' ', array('data-icon' => '&#xf05a;'))}}
                            {{Form::textarea('info','',array('placeholder' => 'Informatie','required' => 'required','rows' => '4'))}}        
                        </p>
                        <p> 
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
        </div>
        <div id="openModal" class="modalDialog">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <h1>Meal Deal</h1>
        <p>"for students by students"</p><br>

        <p><b>Wat is meal deal?</b></p><br>

        <p>Ben je student en heb je soms geen tijd of zin om zelf iets klaar te maken?<br>
        Of ben je misschien een echte keuken prins(es) en hou je ervan om je maaltijden met een andere student te delen?</p><br>

        <p>Dan ben je bij ons op het juiste adres!<br>
        Bij Meal Deal kan je eenvoudig maaltijden vinden en delen met andere studenten in dezelfde regio.</p><br>
            </div>
        </div>

        <div id="openModal2" class="modalDialog">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <h1>Werking</h1>
                <p>Elke nieuwe mealdealer krijgt 5 coins.<br><br>
                Deze kan men gebruiken om maaltijden(deals) van mede-studenten te "kopen".<br><br>
                Je kan ook zelf deals plaatsen en per verkochte deal krijg je dan weer een coin erbij.<br>
                Deze kan je dan weer kan gebruiken om een deal te "kopen". <br><br>
                Bij meal deal kan je evolueren van een keukendummy tot een 3sterren chef.</p><br>

                <p><a class="hovera">Registreer nu om een MealDealer te worden!</a></p>
            </div>
        </div>



    </body>
</html>
