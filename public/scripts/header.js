$(document).ready(function() {
	var loginButton = $('div#login-button');
	var createAccountButton = $('div#create-account-button');
	var logoutButton = $('div#logout-button');
	var myProfileButton = $('div#my-profile-button');
	var homeButton = $('div#home-button');

	var url = window.location.href;
	var regex = /\#(?:access_token)\=([\S\s]*?)(\&)?$/
	console.log(window.location.hash)
	if (url.match(regex) && url.match(regex).length >= 2 && url.match(regex)[1] != '') {
		var access_token = url.match(regex)[1];
		$.cookie('logged-in-user', access_token, {path: '/'});
		var regexUrl = /(?:[\S\s]*:\/\/[^\/]*)(\/[^#]*)(?:\#)/
		var newUrl = url.match(regexUrl)[1];
		url.match(url);
		console.log(url.match(regexUrl));
		console.log(newUrl);
		window.history.pushState("object or string", "Title", newUrl);
		location.reload();
	}

	if  (loginButton) {
		loginButton.click(function() {
				var loginUrl = 'https://foursquare.com/oauth2/authenticate' +
    				'?client_id=5Y2C5XSQYN2ITRUJJOM5EH0MPLGPRI2VL22FPKLDLMSZJZBT' + 
    				'&response_type=token' + 
    				'&redirect_uri=' + window.location;

			window.location = loginUrl;
		});
	}

	if  (createAccountButton) {
		createAccountButton.click(function() {
			location.reload();
		});
	}

	if  (logoutButton) {
		logoutButton.click(function() {
			$.removeCookie("logged-in-user", { path: '/' });
			location.reload();
		});
	}

	if  (myProfileButton) {
		var userId = myProfileButton.data('user-id');
		myProfileButton.click(function() {
			window.location = '/foursquare/profile/?id=' + userId;
		});
	}

	homeButton.click(function() {
		window.location = '/foursquare'
	});
});