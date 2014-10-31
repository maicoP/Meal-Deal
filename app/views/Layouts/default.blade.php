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
    @yield('content')	
    </body>
</html>