//Register Company Page Validation

// 1. Contact Number
const contactNumElement = document.querySelector(
  ".register-company-item .contact"
);
const validateMsgElement = document.getElementById("input-contact-error");
const registerCompanyFormElement = document.querySelector(
  ".register-company form"
);

let isSubmmited = false;

if (registerCompanyFormElement) {
  registerCompanyFormElement.addEventListener("submit", validateContact);
  registerCompanyFormElement.addEventListener("submit", disableFormButton);
}

function validateContact(event) {
  const contact = contactNumElement.value;
  if (contact.length != 10) {
    validateMsgElement.textContent = "*Contact must have 10 numbers!";
    event.preventDefault();
  } else {
    validateMsgElement.textContent = "";
  }
}

// 2. Showing Upload File Name

const registerCsvFileName = document.getElementById("register-csv-file");
const registerCsvFile = document.getElementById("company-csv");

if (registerCsvFile) {
  registerCsvFile.addEventListener("change", showFileName);
}

function showFileName(event) {
  console.log(event);
  let filename = event.srcElement.files[0].name;
  registerCsvFileName.textContent = filename;
}

