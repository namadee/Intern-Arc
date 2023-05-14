
	function validateForm() {
		// Get all the checkboxes
		let checkboxes = document.querySelectorAll('input[type="checkbox"]');

		// Count the number of checkboxes that are checked
		let checkedCount = 0;
		for (let i = 0; i < checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				checkedCount++;
			}
		}

		// Make sure exactly 3 checkboxes are checked
		if (checkedCount !== 3) {
			alert("Please select exactly three job roles.");
			return false; // prevent form submission
		}

		// If we get here, the form is valid
		return true;
	}
	// document.getElementById("modal-box-close").addEventListener("click", function() {

	// 	document.getElementById("my-div").style.display = "none";

	// });
