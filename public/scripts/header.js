$(document).ready(function() {
	var loginButton = $('div#login-button');
	var logoutButton = $('div#logout-button');
	var profileButton = $('div#profile-button');

	if  (loginButton) {
		loginButton.click(function() {
			alert("Logging in");
		});
	}

	if  (logoutButton) {
		logoutButton.click(function() {
			alert("Logging out");
		});
	}

	if  (profileButton) {
		profileButton.click(function() {
			alert("Viewing profile");
		});
	}
});