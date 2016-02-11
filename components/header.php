<div id="header">
	<?php if (isset($_COOKIE['logged-in-user'])): ?>
	<div id="logout-button" class="header-button">Logout</div>
	<?php 
	$users = unserialize(file_get_contents($directory . 'users'));
	$userId = null;
	foreach ($users as $id => $userInfo) {
		if ($userInfo['Auth Token'] == $_COOKIE['logged-in-user']) {
			$userId = $id;
			break;
		}
	}
	if (!is_null($userId)): ?>
	<div id="my-profile-button" class="header-button" data-user-id="<?= $userId ?>">My Profile</div>
	<?php endif; ?>
	<?php else: ?>
	<div id="login-button" class="header-button">Login</div>
	<div id="create-account-button" class="header-button">Create Account</div>
	<?php endif ?>
	<div id="home-button" class="header-button">Home</div>
</div>