// Variables
const productSection = document.body.querySelector("#productInfo");
const mainSection = document.body.querySelector("#main");
const minusButton = document.body.querySelector("#minusBtn");
const numberInput = document.body.querySelector("#number");
const plusButton = document.body.querySelector("#plusBtn");
const successDiv = document.body.querySelector("#success");
const failDiv = document.body.querySelector("#danger");

// Display account sections
document.addEventListener("DOMContentLoaded", function () {
	// set url link
	let typeUrl = window.location.search;
	typeUrl = new URLSearchParams(typeUrl);
	typeUrl = typeUrl.get("type");
	// Login
	if (window.location.toString().includes("baked.php") && typeUrl > 20 && typeUrl <= 40) {
		mainSection.classList.add("d-none");
	} else if (window.location.toString().includes("coffee.php") && typeUrl > 0 && typeUrl <= 20) {
		mainSection.classList.add("d-none");
	}
	// Register
	else {
		productSection.classList.add("d-none");
	}
});

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
