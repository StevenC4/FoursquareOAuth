<div id="header">
	<?php if (isset($_COOKIE['logged-in-user'])): ?>
	<div id="logout-button" class="header-button">Logout</div>
	<div id="my-profile-button" class="header-button">My Profile</div>
	<?php else: ?>
	<div id="login-button" class="header-button">Login</div>
	<?php endif ?>
	<div id="home-button" class="header-button">Home</div>
</div>