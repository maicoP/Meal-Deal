<!doctype hmtl>
<html>
<head>
	<title>Laravel Examen</title>
</head>
<body>
	<div>
		{{link_to("/", "Home")}}
		{{link_to("posts/topPosts", "Top 10 Posts")}}
	</div>
	@yield('content')
</body>
</html>