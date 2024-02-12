// Variables
const loginSection = document.body.querySelector("#login");
const registerSection = document.body.querySelector("#register");

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
	else {
		document.title = "Register - Bean and Brew";
		registerSection.classList.remove("d-none");
	}
});
