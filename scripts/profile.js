// Variables
const accountSection = document.body.querySelector("#account");
const editButton = document.querySelector("#btnEdit");
const updateInputs = document.querySelector("#account").querySelectorAll(".form-control");

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
