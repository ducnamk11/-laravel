
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<title>My Login Page &mdash; Bootstrap 4 Login Page Snippet</title>
	<link rel="stylesheet" type="text/css" href="{{asset('news/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('news/css/my-login.css')}}">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper my-auto">
					@yield('content')
				</div>
			</div>
		</div>
	</section>

	<script src="{{asset('news/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('news/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('news/js/my-login.js')}}"></script>
</body>
</html>