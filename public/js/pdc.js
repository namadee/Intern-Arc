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
}

function validateContact(event) {
  const contact = contactNumElement.value;
  if (contact.length != 10) {
    validateMsgElement.textContent = "*Contact must have 10 numbers!";
    event.preventDefault();
  } else {
    validateMsgElement.textContent = "";
    event.submitter.disabled = true;
  }
}

// 2. Showing Upload File Name

const uploadFileName = document.getElementById("form-file-name");
const companyCsvFile = document.getElementById("company-csv");
const studentsCsvFile = document.getElementById("students-csv");
const profileImgElement = document.getElementById("upload-img");

if (companyCsvFile) {
  companyCsvFile.addEventListener("change", showFileName);
}

if (studentsCsvFile) {
  studentsCsvFile.addEventListener("change", showFileName);
}

if (profileImgElement) {
  profileImgElement.addEventListener("change", showFileName);
}

function showFileName(event) {
  let filename = event.srcElement.files[0].name;
  uploadFileName.textContent = filename;
}

// 3. Stop Multiple Submissions - CSV Registration Forms & Student Registration Form

const csvRegistrationElement = document.getElementById("csvFormRegistration");
const studentRegFormElement = document.getElementById("student-register-form");

if (csvRegistrationElement) {
  csvRegistrationElement.addEventListener("submit", preventMultipleSubmissions);
}

if (studentRegFormElement) {
  studentRegFormElement.addEventListener("submit", preventMultipleSubmissions);
}

function preventMultipleSubmissions(event) {
  event.submitter.disabled = true;
}

// 4. Check Image Size

//binds to onchange event of your input field
$("#myFile").bind("change", function () {
  console.log(this.files[0].size);
  //this.files[0].size gets the size of your file.
  alert(this.files[0].size);
});

// 5. Bacth Year Max Length

const stdBatchYrForm = document.getElementById("add-student-batch");
const batchYear = document.getElementById("batch-year-input");
const batchYrError = document.getElementById("validate-error");

if (stdBatchYrForm) {
  stdBatchYrForm.addEventListener("submit", batchYearValidate);
}

function batchYearValidate(event) {
  let currentYear = new Date().getFullYear();
  upperLimit = currentYear - 4; //2019
  lowerLimit = currentYear - 8; //2019 - 4

  if (batchYear.value.length != 4) {
    batchYrError.textContent = "*Please enter a valid Year!";
    event.preventDefault();
    return false;
  }

  if (batchYear.value < lowerLimit || batchYear.value > upperLimit) {
    batchYrError.textContent =
      "*Please enter a Year Beween " + lowerLimit + " and " + upperLimit;
    event.preventDefault();
    return false;
  }
}

// 6. View Rename Batch Year Button

const renameBatchYearBtn = document.getElementById("renameBatchyearBtn");
if (renameBatchYearBtn) {
  renameBatchYearBtn.addEventListener("click", toggleBatchYearForm);
}

function toggleBatchYearForm() {
  const batchRenameForm = document.getElementById("rename-student-batch");

  if (batchRenameForm.classList.contains("hide-element")) {
    batchRenameForm.classList.remove("hide-element");
  } else {
    batchRenameForm.classList.add("hide-element");
  }
}

const stdBatchYrRenameForm = document.getElementById("rename-student-batch");
const batchYearRename = document.getElementById("rename-batch-year-input");
const batchYrRenameError = document.getElementById("validate-error-rename");

if (stdBatchYrRenameForm) {
  stdBatchYrRenameForm.addEventListener("submit", batchYearValidateRename);
}

function batchYearValidateRename(event) {
  let currentYear = new Date().getFullYear();
  upperLimit = currentYear; //2023
  lowerLimit = currentYear - 4; //2023 - 4

  if (batchYearRename.value.length != 4) {
    batchYrRenameError.textContent = "*Please enter a valid Year!";
    event.preventDefault();
    return false;
  }

  if (
    batchYearRename.value < lowerLimit ||
    batchYearRename.value > upperLimit
  ) {
    batchYrRenameError.textContent =
      "*Please enter a Year Beween " + lowerLimit + " and " + upperLimit;
    event.preventDefault();
    return false;
  }
}

// 7. Validate Round period duration

const round1StartDate = document.getElementById("first_round_start");
const round1EndDate = document.getElementById("first_round_end");
const round2StartDate = document.getElementById("second_round_start");
const round2EndDate = document.getElementById("second_round_end");

// Set minimum and default values for round1StartDate
const timeZoneOffset = 330; // Sri Lanka is GMT+5:30
const now = new Date();
now.setHours(now.getHours() + timeZoneOffset / 60); // set hours based on offset
now.setMinutes(now.getMinutes() + (timeZoneOffset % 60)); // set minutes based on offset
const today = now.toISOString().split("T")[0]; // get today's date in ISO format with Sri Lanka's timezone

//ROUND 1
// Set minimum default value for round1StartDate
round1StartDate.setAttribute("min", today);
// round1StartDate.setAttribute("value", today);

round2StartDate.setAttribute("min", today);
round2EndDate.setAttribute("min", today);

// Set minimum and default values for round1EndDate
const round1EndMin = new Date(round1StartDate.min);
round1EndMin.setDate(round1EndMin.getDate() + 1);
round1EndDate.setAttribute("min", round1EndMin.toISOString().split("T")[0]);
// round1EndDate.setAttribute("value", round1EndMin.toISOString().split("T")[0]);

// Update minimum and default values for round1EndDate when round1StartDate changes
round1StartDate.addEventListener("change", function () {
  const round1EndMin = new Date(round1StartDate.value);
  round1EndMin.setDate(round1EndMin.getDate() + 1);
  round1EndDate.setAttribute("min", round1EndMin.toISOString().split("T")[0]);
  // round1EndDate.setAttribute("value", round1EndMin.toISOString().split("T")[0]);
});

//ROUND 2

//Event listner for round1EndDate
round1EndDate.addEventListener("change", function () {
  const round1EndMin = new Date(round1EndDate.value);
  round1EndMin.setDate(round1EndMin.getDate() + 1);
  round2StartDate.setAttribute("min", round1EndMin.toISOString().split("T")[0]);
  // round1EndDate.setAttribute("value", round1EndMin.toISOString().split("T")[0]);
});

//Event listner for round2StartDate
round2StartDate.addEventListener("change", function () {
  const round2EndMin = new Date(round2StartDate.value);
  round2EndMin.setDate(round2EndMin.getDate() + 1);
  round2EndDate.setAttribute("min", round2EndMin.toISOString().split("T")[0]);
  // round1EndDate.setAttribute("value", round1EndMin.toISOString().split("T")[0]);
});

