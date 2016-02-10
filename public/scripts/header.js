$(document).ready(function() {
	var loginButton = $('div#login-button');
	var logoutButton = $('div#logout-button');
	var myProfileButton = $('div#my-profile-button');
	var homeButton = $('div#home-button');

	if  (loginButton) {
		loginButton.click(function() {
			document.cookie = "logged-in-user=sdf938s9f892032";
			location.reload();
		});
	}

	if  (logoutButton) {
		logoutButton.click(function() {
    		document.cookie = "logged-in-user=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
			location.reload();
		});
	}

	if  (myProfileButton) {
		myProfileButton.click(function() {
			window.location = '/foursquare/profile'
		});
	}

	homeButton.click(function() {
		window.location = '/foursquare'
	});
});