<!doctype hmtl>
<html>
<head>
	<title>Laravel Examen</title>
	{{ HTML::style('css/style.css'); }}
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- 	<div>
	{{link_to("/", "Home")}}
	{{link_to("posts/topPosts", "Top 10 Posts")}}
</div> -->

<div class="navigation">
	<nav id="rolling-nav">
	    <ul>
	        <li><a href="/" data-clone="Find Deals">Find Deals</a></li>
	        <li><a href="posts/topPosts" data-clone="Beste Deals">Beste Deals</a></li>
	        <li><a href="#" data-clone="Create Deal">Create Deal</a></li>
	        <li><a href="#" data-clone="Profiles">Profiles</a></li>
	    </ul>
	</nav>
</div>

	@yield('content')
</body>
</html>