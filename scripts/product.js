// Variables
const productSection = document.body.querySelector("#productInfo");
const mainSection = document.body.querySelector("#main");
const minusButton = document.body.querySelector("#minusBtn");
const numberInput = document.body.querySelector("#number");
const plusButton = document.body.querySelector("#plusBtn");

// Display account sections
document.addEventListener("DOMContentLoaded", function () {
	// set url link
	let webUrl = window.location.search;
	webUrl = new URLSearchParams(webUrl);
	webUrl = webUrl.get("type");
	// Login
	if (webUrl > 0 && webUrl <= 40) {
		mainSection.classList.add("d-none");
	}
	// Register
	else {
		productSection.classList.add("d-none");
	}
});

// Quantity Input Box

// Minus Button
minusButton.onclick = () => {
	let number = numberInput.value;
	number--;
	number <= 0 ? (numberInput.value = 0) : (numberInput.value = number);
};

// Plus Button
plusButton.onclick = () => {
	let number = numberInput.value;
	number++;
	numberInput.value = number;
};
