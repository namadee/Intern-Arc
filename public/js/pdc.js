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

const indexValidateMsg = document.getElementById("validate-error-indexNumber");
const registerStudentFormElement = document.getElementById(
  "student-register-form"
);

let indexNumberElement = document.getElementById("index_number");

if (registerStudentFormElement) {
  registerStudentFormElement.addEventListener("submit", validateIndexNumber);
}

function validateIndexNumber(event) {
  const indexNum = indexNumberElement.value;
  if (indexNum.length != 8) {
    indexValidateMsg.textContent = "*Index Number must have 8 numbers!";
    event.preventDefault();
  } else {
    indexValidateMsg.textContent = "";
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
  upperLimit = currentYear; //2023
  lowerLimit = currentYear - 4; //2019 - 4

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

// const stdBatchYrRenameForm = document.getElementById("rename-student-batch");
// const batchYearRename = document.getElementById("rename-batch-year-input");
// const batchYrRenameError = document.getElementById("validate-error-rename");

// if (stdBatchYrRenameForm) {
//   stdBatchYrRenameForm.addEventListener("submit", batchYearValidateRename);
// }

// function batchYearValidateRename(event) {
//   let currentYear = new Date().getFullYear();
//   upperLimit = currentYear; //2023
//   lowerLimit = currentYear - 4; //2023 - 4

//   if (batchYearRename.value.length != 4) {
//     batchYrRenameError.textContent = "*Please enter a valid Year!";
//     event.preventDefault();
//     return false;
//   }

//   if (
//     batchYearRename.value < lowerLimit ||
//     batchYearRename.value > upperLimit
//   ) {
//     batchYrRenameError.textContent =
//       "*Please enter a Year Beween " + lowerLimit + " and " + upperLimit;
//     event.preventDefault();
//     return false;
//   }
// }

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

if (round1StartDate) {
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
}

//ROUND 2

if (round1EndDate) {
  //Event listner for round1EndDate
  round1EndDate.addEventListener("change", function () {
    const round1EndMin = new Date(round1EndDate.value);
    round1EndMin.setDate(round1EndMin.getDate() + 1);
    round2StartDate.setAttribute(
      "min",
      round1EndMin.toISOString().split("T")[0]
    );
    // round1EndDate.setAttribute("value", round1EndMin.toISOString().split("T")[0]);
  });
}

if (round2StartDate) {
  //Event listner for round2StartDate
  round2StartDate.addEventListener("change", function () {
    const round2EndMin = new Date(round2StartDate.value);
    round2EndMin.setDate(round2EndMin.getDate() + 1);
    round2EndDate.setAttribute("min", round2EndMin.toISOString().split("T")[0]);
    // round1EndDate.setAttribute("value", round1EndMin.toISOString().split("T")[0]);
  });
}

// 8. Live Search

//8.1 Company Search PDC
let pdcSearchCompany = document.getElementById("pdc_search_company");
let pdcResultCompany = document.getElementById("pdc_company_result");

if (pdcSearchCompany) {
  pdcSearchCompany.addEventListener("keyup", searchCompanyPdc);
}

function searchCompanyPdc() {
  let searchText = $(this).val();
  if (searchText != "") {
    pdcResultCompany.style.display = "flex";
    $.ajax({
      url: "http://localhost/internarc/ajax",
      method: "POST",
      data: { query: searchText },
      success: function (response) {
        pdcResultCompany.innerHTML = response;
      },
    });
  } else {
    pdcResultCompany.style.display = "none";
  }
}

//8.2 Student Index Search PDC
let pdcSearchStudent = document.getElementById("pdc_search_student");
let studentYear = document.getElementById("pdc-student-list-batch-year");
let studentStream = document.getElementById("pdc-student-list-stream");
let pdcResultStudent = document.getElementById("pdc_student_result");

if (pdcSearchStudent) {
  pdcSearchStudent.addEventListener("keyup", searchStudentPdc);
  abbrevatedStream = convertToAbbreviation(studentStream.textContent);
}

function convertToAbbreviation(str) {
  switch (str) {
    case "Computer Systems":
      return "CS";
    case "Information Systems":
      return "IS";
    default:
      return str;
  }
}

function searchStudentPdc() {
  let searchText = $(this).val();
  if (searchText != "") {
    pdcResultStudent.style.display = "flex";
    $.ajax({
      url: "http://localhost/internarc/ajax/searchStudentByIndex",
      method: "POST",
      data: {
        query: searchText,
        batchYear: studentYear.textContent.trim(),
        stream: abbrevatedStream,
      },
      success: function (response) {
        pdcResultStudent.innerHTML = response;
      },
    });
  } else {
    pdcResultStudent.style.display = "none";
  }
}

//8.3 PDC Advertisement Search

let pdcSearchAdvertisement = document.getElementById(
  "pdc_advertisement_search"
);
let pdcResultAdvertisement = document.getElementById(
  "pdc_advertisement_result"
);
let pdcAdvertisementBatchYear = document.getElementById(
  "current_batchyear_advertisement_span"
);

if (pdcSearchAdvertisement) {
  pdcSearchAdvertisement.addEventListener("keyup", searchAdvertisementPdc);
}

function searchAdvertisementPdc() {
  let searchText = $(this).val();

  if (searchText != "") {
    pdcResultAdvertisement.style.display = "flex";
    $.ajax({
      url: "http://localhost/internarc/ajax/searchAdvertisementByBatchYear",
      method: "POST",
      data: {
        query: searchText,
        batchYear: pdcAdvertisementBatchYear.textContent.trim(),
      },
      success: function (response) {
        pdcResultAdvertisement.innerHTML = response;
      },
    });
  } else {
    pdcResultAdvertisement.style.display = "none";
  }
}

//8.4 PDC Request Search

//8.4.1 PDC Request Search CS

let pdcSearchRequestCS = document.getElementById("pdc_request_cs_search");
let pdcResultRequestCS = document.getElementById("pdc_request_cs_result");

if (pdcSearchRequestCS) {
  pdcSearchRequestCS.addEventListener("keyup", searchRequestByYearRoundCS);
}

function searchRequestByYearRoundCS() {
  let searchText = $(this).val();

  if (searchText != "") {
    pdcResultRequestCS.style.display = "flex";
    $.ajax({
      url: "http://localhost/internarc/ajax/searchRequestByYearRound",
      method: "POST",
      data: {
        query: searchText,
        stream: "CS",
        batchYear: pdcSearchRequestCS.dataset.batchYear.trim(),
        round: pdcSearchRequestCS.dataset.round.trim(),
      },
      success: function (response) {
        pdcResultRequestCS.innerHTML = response;
      },
    });
  } else {
    pdcResultRequestCS.style.display = "none";
  }
}

//8.4.2 PDC Request Search IS
let pdcSearchRequestIS = document.getElementById("pdc_request_is_search");
let pdcResultRequestIS = document.getElementById("pdc_request_is_result");

if (pdcSearchRequestIS) {
  pdcSearchRequestIS.addEventListener("keyup", searchRequestByYearRoundIS);
}

function searchRequestByYearRoundIS() {
  let searchText = $(this).val();

  if (searchText != "") {
    pdcResultRequestIS.style.display = "flex";
    $.ajax({
      url: "http://localhost/internarc/ajax/searchRequestByYearRound",
      method: "POST",
      data: {
        query: searchText,
        stream: "IS",
        batchYear: pdcSearchRequestCS.dataset.batchYear.trim(),
        round: pdcSearchRequestCS.dataset.round.trim(),
      },
      success: function (response) {
        pdcResultRequestIS.innerHTML = response;
      },
    });
  } else {
    pdcResultRequestIS.style.display = "none";
  }
}

// 9  Chnage password

//Toggle Password Visibility Function - Forgot Password functionality
const toggleIconChangePwd = document.getElementById("toggleIconChangePwd");
const newPasswordField = document.getElementById("user_new_password");
const confirmPasswordField = document.getElementById("user_confirm_password");
const oldPasswordField = document.getElementById("user_old_password");

if (toggleIconChangePwd) {
  toggleIconChangePwd.addEventListener("click", togglePasswordVisibilityUser);
}

function togglePasswordVisibilityUser() {
  if (newPasswordField.type === "password") {
    newPasswordField.type = "text";
    confirmPasswordField.type = "text";
    oldPasswordField.type = "text";
    toggleIconChangePwd.textContent = "visibility";
  } else {
    newPasswordField.type = "password";
    confirmPasswordField.type = "password";
    oldPasswordField.type = "password";
    toggleIconChangePwd.textContent = "visibility_off";
  }
}

//Validate Password
const changePwdForm = document.getElementById("change_password_pdc");
const ChangePasswordValidateError = document.getElementById(
  "changePwd_validate_error"
);
if (changePwdForm) {
  changePwdForm.addEventListener("submit", checkConfirmPasswordFunction);
}

const specialCharFormat = new RegExp("(?=.*[!@#$%^&*])");
const upperCaseFormat = new RegExp("(?=.*[A-Z])");

function checkConfirmPasswordFunction(event) {
  const passwordInput = document.getElementById("user_new_password").value;
  const confirmPasswordInput = document.getElementById(
    "user_confirm_password"
  ).value;

  if (
    specialCharFormat.test(passwordInput) &&
    upperCaseFormat.test(passwordInput)
  ) {
    console.log("Special char found and Have Uppercase");
    if (passwordInput != confirmPasswordInput) {
      event.preventDefault();
      ChangePasswordValidateError.textContent =
        "The Confirm Password does not match";
      ChangePasswordValidateError.style.display = "block";
    }
  } else {
    event.preventDefault();
    ChangePasswordValidateError.textContent =
      "The New Password must contain atleast 1 Uppercase Letter and any Special Character";
    ChangePasswordValidateError.style.display = "block";
  }
}
