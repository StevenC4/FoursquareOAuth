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

			echo "<pre>";
			// print_r($data);

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
			if ($data->response->user->checkins->count >= 1) {
				// print_r($data->response->user->checkins->items[0]);
				$checkinData = $data->response->user->checkins->items[0];
				$checkin = array();
				$date = new DateTime();
				if ($checkinData->venue->name) $checkin['Venue Name'] = $checkinData->venue->name;
				if ($checkinData->createdAt) {
					$date = new DateTime();
					$date->setTimestamp($checkinData->createdAt);
					$date->setTimezone(new DateTimeZone('MST'));
					$checkin['Date'] = $date->format('m/d/Y');
					$checkin['Time'] = $date->format('H:i:s');
				}
				if ($checkinData->venue->location->address) $checkin['Address'] = $checkinData->venue->location->address;
				if ($checkinData->venue->location->postalCode) $checkin['ZIP'] = $checkinData->venue->location->postalCode;
				if ($checkinData->venue->location->city) $checkin['City'] = $checkinData->venue->location->city;
				if ($checkinData->venue->location->state) $checkin['State'] = $checkinData->venue->location->state;
				if ($checkinData->venue->location->country) $checkin['Country'] = $checkinData->venue->location->country;

				$user['Latest Checkin'] = $checkin;
			}
			$user['Number of Checkins'] = $data->response->user->checkins->count;
			$user['Auth Token'] = $authToken;

			$users[$user['ID']] = $user;

			file_put_contents($filepath, serialize($users));
		} else {
			if (!file_exists($filepath)) {
				file_put_contents($filepath, serialize(array()));
			}
		}
	?>