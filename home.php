<html>
<head>
	<title>Metube</title>
	<link rel="stylesheet" type="text/css" href="/metube/css/default.css">
</head>
<body>
	<div class='header'>
		<a id='logo-container' href='/metube/home.php' title='MeTube home'>
		<img id='logo' src="/metube/images/metube_logo.jpg" alt='Metube Home'>
		</a>

		<div class='search-container'>
				<input type='text' class='search'>
				<button class='searchbutton' type='button'>Search
				</button>
		</div>
		<button onclick="/metube/index.php" class="signinbutton" type="button">
			<span id='buttontext'>Sign in</span>
		</button>

	</div>
<p><?php session_start(); echo $_SESSION['username'];?></p>	