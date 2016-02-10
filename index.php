<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="/foursquare/public/scripts/header.js"></script>
	<link rel="stylesheet" type="text/css" href="/foursquare/public/stylesheet/main.css">
	<title>Foursquare OAuth App</title>
</head>
<body>
<div id="header">
	<?php if (isset($_COOKEIS['logged-in-user'])): ?>
	<?php else: ?>
	<div class="header-button">Login</div>
	<?php endif ?>
</div>
</body>
</html>