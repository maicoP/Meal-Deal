<!doctype hmtl>
<html>
<head>
	<title>Laravel Examen</title>
</head>
<body>
<body>
	<div>
		{{link_to("logout", "Logout")}}
	</div>
	<div>
		{{link_to("deals", "Home")}}
		{{link_to("deals/create", "Deal plaatsen")}}
	</div>
	@yield('content')
</body>
</html>