<!DOCTYPE html>
<html>
<?php 
$title = 'Home page';
$directory = "./";
include 'components/head.php'; 
?>
<body>
	<?php 
	include 'components/header.php';
	include 'components/login.php';
	$users = unserialize(file_get_contents($filepath)); ?>
	<div class="home-users-list">
		<h1>Users</h1>
		<?php foreach ($users as $id => $userInfo): ?>
		<a href='/foursquare/profile/?id=<?= $id ?>'><?= $userInfo['First Name'] . " " . (isset($userInfo['Last Name']) ? $userInfo['Last Name'] : "") ?></a>
		<?php endforeach; ?>
	</div>
</body>
</html>