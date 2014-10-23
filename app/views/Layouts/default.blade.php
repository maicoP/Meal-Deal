<!doctype hmtl>
<html>
<head>
	<title>Meal Deal</title>
</head>
<body>
	<div>
		{{link_to("/", "Home")}}
		{{link_to("posts/topPosts", "Top 10 Posts")}}
	</div>
	@yield('content')
</body>
</html>