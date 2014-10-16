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
		{{link_to("posts", "Home")}}
		{{link_to("posts/create", "Make Post")}}
		{{link_to("votes", "Posts I voted on")}}
		{{link_to("posts/topPosts", "Top 10 Posts")}}
	</div>
	@yield('content')
</body>
</html>