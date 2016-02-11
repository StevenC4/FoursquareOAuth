<?php
		$filepath = $directory . 'users';

		if (isset($_COOKIE['logged-in-user'])) {
			$authToken = $_COOKIE['logged-in-user'];
			$url = "https://api.foursquare.com/v2/users/self?oauth_token=" . $authToken . "&v=20160210";
			$ch = curl_init();
			curl_setopt_array($ch,  array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_SSL_VERIFYPEER => false
			));
			$data = json_decode(curl_exec($ch));
			curl_close($ch);

			if (file_exists($filepath)) {
				$users = unserialize(file_get_contents($filepath));
			} else {
				$users = array();
			}

			$user = array();
			$user['ID'] = $data->response->user->id;
			$user['First Name'] = $data->response->user->firstName;
			if ($data->response->user->lastName) $user['Last Name'] = $data->response->user->lastName;
			if ($data->response->user->gender) $user['Gender'] = $data->response->user->gender;
			if ($data->response->user->homeCity) $user['Home City'] = $data->response->user->homeCity;
			$user['Checkins'] = $data->response->user->checkins->count;
			$user['Auth Token'] = $authToken;

			$users[$user['ID']] = $user;

			file_put_contents($filepath, serialize($users));
		} else {
			if (!file_exists($filepath)) {
				file_put_contents($filepath, serialize(array()));
			}
		}
	?>