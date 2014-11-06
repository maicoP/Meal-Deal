<!doctype hmtl>
<html>
<head>
	<title>Meal Deal</title>
</head>
<body>
<body>
	<div>
		{{link_to("logout", "Logout")}}
	</div>
	<div>
		{{link_to("deals", "Home")}}
		{{link_to("deals/create", "Deal Plaatsen")}}
		{{link_to("mydeals", "Mijn Deals")}}
		{{link_to("user/profielen", "Profielen")}}
		{{link_to("user/instellingen", "Instellingen")}}
	</div>
	@yield('content')
</body>
</html>