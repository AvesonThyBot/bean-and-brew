// Variables
const loginSection = document.body.querySelector("#login");
const registerSection = document.body.querySelector("#register");
const accountSection = document.body.querySelector("#account");
const editButton = document.querySelector("#btnEdit");
const updateInputs = document.querySelector("#account").querySelectorAll(".form-control");

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

// Toggle edit
editButton.onclick = () => {
	// Change edit buttons text content
	if (updateInputs[0].classList.contains("disable-input")) {
		editButton.textContent = "Save";
	} else {
		editButton.textContent = "Edit";
	}

	// toggle disable-input class for each element
	updateInputs.forEach((element) => {
		element.classList.toggle("disable-input");
	});
};
