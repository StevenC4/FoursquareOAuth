<!DOCTYPE html>
<html>
<?php 
$title = 'Profile page';
$directory = "../";
include '../components/head.php'; 
?>
<body>
	<div class="profile-page">
	<?php 
	include '../components/header.php';
	include '../components/login.php';
	$id = null;
	$userInfo = null;
	if (isset($_SERVER['QUERY_STRING'])) {
		$queryString = explode('&', $_SERVER['QUERY_STRING']);
		for ($i = 0; $i < count($queryString); $i++) {
			$value = $queryString[$i];
			$parts = explode('=', $value);
			if ($parts[0] == 'id') {
				$id = $parts[1];
				break;
			}
		}
	}
	if (!is_null($id)) {
		$users = unserialize(file_get_contents($directory . "users"));
		if (isset($users[$id])) {
			$userInfo = $users[$id];
		}
	}
	if (!is_null($userInfo)): ?>
	<h1><?= $userInfo['First Name'] . " " . (isset($userInfo['Last Name']) ? $userInfo['Last Name'] : "") ?>'s User Info</h1>
	<table>
		<tbody>
			<?php foreach ($userInfo as $name => $value): ?>
				<?php if ($name != 'Auth Token'): ?>
					<tr><td><?= $name ?></td><td><?= $value ?></td></tr>
				<?php endif; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
	
	<?php if (isset($_COOKIE['logged-in-user']) && $userInfo['Auth Token'] == $_COOKIE['logged-in-user']): 
		$authToken = $_COOKIE['logged-in-user'];
		$url = "https://api.foursquare.com/v2/users/" . $id . "/checkins?oauth_token=" . $authToken . "&v=20160210";
		$ch = curl_init();
		curl_setopt_array($ch,  array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_SSL_VERIFYPEER => false
		));
		$data = json_decode(curl_exec($ch));
		curl_close($ch);
		echo "<pre>";
		print_r($data->response->checkins);
	?>
	<h1>Checkins</h1>
	<?php endif; ?>
	<?php else: ?>
	No user ID provided in the querystring or the userID was invalid
	<?php endif; ?>
	</div>
</body>
</html>