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
	if (!is_null($userInfo)): 

		$authToken = $userInfo['Auth Token'];
		$url = "https://api.foursquare.com/v2/users/" . $id . "/checkins?oauth_token=" . $authToken . "&v=20160210";
		$ch = curl_init();
		curl_setopt_array($ch,  array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_SSL_VERIFYPEER => false
		));
		$checkinsObject = json_decode(curl_exec($ch));
		curl_close($ch);

	?>
	<h1><?= $userInfo['First Name'] . " " . (isset($userInfo['Last Name']) ? $userInfo['Last Name'] : "") ?>'s User Info</h1>
	<table>
		<tbody>
			<?php foreach ($userInfo as $name => $value): ?>
				<?php if ($name != 'Auth Token' && $name != 'Latest Checkin'): ?>
					<tr><td><?= $name ?></td><td><?= $value ?></td></tr>
				<?php endif; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
	
	<h1>Latest Checkin</h1>
	<?php 
		$numCheckins = $checkinsObject->response->checkins->count;
		$checkinsObject = $checkinsObject->response->checkins->items;
		$checkins = array();
		for ($i = 0; $i < $numCheckins; $i++) {
			$checkin = array();
			$checkinObject = $checkinsObject[$i];

			if ($checkinObject->venue->name) $checkin['Venue Name'] = $checkinObject->venue->name;
			if ($checkinObject->createdAt) {
				$date = new DateTime();
				$date->setTimestamp($checkinObject->createdAt);
				$date->setTimezone(new DateTimeZone('MST'));
				$checkin['Date'] = $date->format('m/d/Y');
				$checkin['Time'] = $date->format('H:i:s');
			}
			if ($checkinObject->venue->location->address) $checkin['Address'] = $checkinObject->venue->location->address;
			if ($checkinObject->venue->location->postalCode) $checkin['ZIP'] = $checkinObject->venue->location->postalCode;
			if ($checkinObject->venue->location->city) $checkin['City'] = $checkinObject->venue->location->city;
			if ($checkinObject->venue->location->state) $checkin['State'] = $checkinObject->venue->location->state;
			if ($checkinObject->venue->location->country) $checkin['Country'] = $checkinObject->venue->location->country;

			array_push($checkins, $checkin);	
		}

	if (!empty($checkins)): ?>
	<table>
		<tbody>
		<?php foreach ($checkins[0] as $name => $value): ?>
			<tr><td><?= $name ?></td><td><?= $value ?></td></tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<?php endif;
	if (isset($_COOKIE['logged-in-user']) && $userInfo['Auth Token'] == $_COOKIE['logged-in-user']): 
		
		// print_r($data->response->checkins);
	?>
	<h1>Checkins</h1>
	<?php foreach ($checkins as $i => $checkin): ?>
	<table>
		<tbody>
		<?php 
		foreach ($checkin as $name => $value): ?>
			<tr><td><?= $name ?></td><td><?= $value ?></td></tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php endforeach ?>

	<?php endif; ?>
	<?php else: ?>
	No user ID provided in the querystring or the userID was invalid
	<?php endif; ?>
	</div>
</body>
</html>