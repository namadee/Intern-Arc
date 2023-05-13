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

// Report - Company List
let companyRegisteredYear = document.getElementById(
  "admin_company_register_year"
);
let companyRegisterYearSearchBtn = document.getElementById(
  "admin_company_register_btn"
);
let companyRegisterYearSearchElement = document.getElementById(
  "search-element-company-reg-year"
);

let invalidYearErrorMsg = document.getElementById("invalid-year-error-msg");

if (companyRegisterYearSearchBtn) {
  companyRegisterYearSearchBtn.addEventListener("click", getTheSearchYear);
}

function getTheSearchYear(event) {
  const year = companyRegisteredYear.value;

  currentYear = new Date().getFullYear();

  if (year !== "") {
    if (year < 2005 || year > currentYear) {
      event.preventDefault();
      invalidYearErrorMsg.style.display = "block";
    } else {
      companyRegisterYearSearchElement.href =
        "http://localhost/internarc/admin/get-company-registrations/" + year;
    }
  } else {
    event.preventDefault();
  }
}

// Report - Round Period
const select1Round = document.getElementById("reportRoundSelect");
const select2BatchYear = document.getElementById("reportBacthYearSelect");
const searchRoundReportButton = document.getElementById(
  "search-element-round-report-btn"
);

if (searchRoundReportButton) {
  searchRoundReportButton.addEventListener("click", getBatchAndRound);
}

function getBatchAndRound(event) {
  const selectRoundValue = select1Round.value;
  const selectBatchYearValue = select2BatchYear.value;
  const href = `http://localhost/internarc/admin/get-round-reports/${selectBatchYearValue}/${selectRoundValue}`;
  searchRoundReportButton.setAttribute("href", href);
}

// 8. Live Search

//8.1 Company Search PDC
let pdcSearchCompany = document.getElementById("admin_search_company");
let pdcResultCompany = document.getElementById("admin_company_result");

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
let pdcSearchStudent = document.getElementById("admin_search_student");
let studentYear = document.getElementById("admin-student-list-batch-year");
let studentStream = document.getElementById("admin-student-list-stream");
let pdcResultStudent = document.getElementById("admin_student_result");

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
  "admin_advertisement_search"
);
let pdcResultAdvertisement = document.getElementById(
  "admin_advertisement_result"
);
let pdcAdvertisementBatchYear = document.getElementById(
  "current_batchyear_advertisement_span_admin"
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

//8.1 Complaint Search Admin
let adminSearchComplaint = document.getElementById("admin_search_complaint");
let adminResultComplaint = document.getElementById("admin_complaint_result");

if (adminSearchComplaint) {
  adminSearchComplaint.addEventListener("keyup", searchCompanyPdc);
}

function searchCompanyPdc() {
  let searchText = $(this).val();
  if (searchText != "") {
    adminResultComplaint.style.display = "flex";
    $.ajax({
      url: "http://localhost/internarc/ajax/searchComplaint",
      method: "POST",
      data: { query: searchText },
      success: function (response) {
        adminResultComplaint.innerHTML = response;
      },
    });
  } else {
    adminResultComplaint.style.display = "none";
  }
}