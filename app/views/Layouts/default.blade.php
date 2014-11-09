<?php
function setActive($route, $class = 'current-menu-item') {
return (Route::current()->uri() == $route) ? $class : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
		@yield('title')
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Montserrat%3A400%2C700' type='text/css' media='all' />
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>
	{{HTML::style('css/home/font-awesome-4.2.0/css/font-awesome.min.css'); }}
	{{HTML::style("css/reset.css")}}
	{{HTML::style("css/style.css")}}
</head>
<body>
	<div class="navigation-box">
		<div class="navigation">
			<div class="row">
				<div class="menulinks nav-wrap">
					<nav class="main-nav to-left">
						<ul class="navigation-list clearfix"> 
							<li class="menu-item {{setActive('mydeals')}}">{{link_to("mydeals", "Mijn Deals")}}</li>
							<li class="menu-item {{setActive('deals/create')}}">{{link_to("deals/create", "Deal Plaatsen")}}</li>
							<li  class="menu-item {{setActive('deals')}}">{{link_to("deals", "Deal Zoeken")}}</li>
						</ul>
					</nav>
				</div>
				<div class="logodiv">
					<div class="logo aligncenter">
							{{ HTML::image('css/img/logo.png', '', ['class' => 'imglogo']) }}

					</div>
					<div class="menu-button alignleft"></div>
				</div>
				<div class="menulinks nav-wrap">
					<nav class="main-nav to-right">
						<ul class="navigation-list clearfix"> 
							<li class="menu-item {{setActive('user/profielen')}}">{{link_to("user/profielen", "Profielen")}}</li>
							<li class="menu-item {{setActive('user/instellingen')}}">{{link_to("user/instellingen", "Instellingen")}}</li>
							<li class="menu-item">{{link_to("logout", "Logout")}}</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="content">
			@yield('content')
		</div>
		<div class="footer">
			<div class="minifooter">Copyright 2014 MealDeal | Maico Paulussen &amp; Matthias Verhoeven</div>
		</div>
	</div>
</body>
</html>