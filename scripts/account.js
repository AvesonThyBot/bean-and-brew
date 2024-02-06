// Variables
const loginSection = document.body.querySelector("#login");
const registerSection = document.body.querySelector("#register");
const accountSection = document.body.querySelector("#account");

// Display account sections
document.addEventListener("DOMContentLoaded", function () {
	// set url link
	let webUrl = window.location.search;
	webUrl = new URLSearchParams(webUrl);
	webUrl = webUrl.get("type");
	// Login
	if (webUrl == "login") {
		document.title = "Login - Bean and Brew";
		loginSection.classList.remove("d-none");
	}
	// Register
	else if (webUrl == "register") {
		document.title = "Register - Bean and Brew";
		registerSection.classList.remove("d-none");
	}
	// Account
	else if (webUrl == "account") {
		document.title = "Settings - Bean and Brew";
		accountSection.classList.remove("d-none");
	} else if (webUrl !== "logout") {
		document.title = "Register - Bean and Brew";
		registerSection.classList.remove("d-none");
	}
});
