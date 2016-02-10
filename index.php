<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/foursquare/public/stylesheet/main.css">
	<link rel="stylesheet" type="text/css" href="/foursquare/public/stylesheet/reset.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="/foursquare/public/scripts/header.js"></script>
	<title>Foursquare OAuth App</title>
</head>
<body>
<div id="header">
	<?php if (isset($_COOKIE['logged-in-user'])): ?>
	<div id="logout-button" class="header-button">Logout</div>
	<div id="profile-button" class="header-button">Profile</div>
	<?php else: ?>
	<div id="login-button" class="header-button">Login</div>
	<?php endif ?>
</div>
</body>
</html>