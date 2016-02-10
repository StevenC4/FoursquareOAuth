$(document).ready(function() {
	var loginButton = $('div#login-button');
	var logoutButton = $('div#logout-button');
	var profileButton = $('div#profile-button');

	if  (loginButton) {
		loginButton.click(function() {
			document.cookie = "logged-in-user=sdf938s9f892032";
			location.reload();
		});
	}

	if  (logoutButton) {
		logoutButton.click(function() {
    		document.cookie = name + "logged-in-user=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
			location.reload();
		});
	}

	if  (profileButton) {
		profileButton.click(function() {
			alert("Viewing profile");
		});
	}
});