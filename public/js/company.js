//Add requirements as a list

let addReq = document.getElementById("addreq");

if (addReq) {
  addReq.addEventListener("click", addRequirements);
}

function addRequirements() {
  var text = document.getElementById("requirements").value;
  console.log(text);
  var li =
    "<li>" +
    '<span id="dot-icon" class="material-symbols-outlined">fiber_manual_record</span>' +
    text +
    "</li>";
  //document.getElementById("list").insertAdjacentHTML('beforeend', li);
  let element = document.getElementById("requirements-list");
  element.value += text + "\n";
  document.getElementById("requirements").value = ""; // clear the value
  document.getElementById("list").style.listStyleType = "square";
}

// 8. Live Search

//8.1 Company Search PDC
let pdcSearchCompany = document.getElementById("company_search_ad");
let pdcResultCompany = document.getElementById("company_ad_result");
let searchCompanyID = document.getElementById("company_search_ad");

if (pdcSearchCompany) {
  pdcSearchCompany.addEventListener("keyup", searchCompanyPdc);
}

function searchCompanyPdc() {
  let companyIdSearch = pdcSearchCompany.getAttribute("data-company-id");
  let searchText = $(this).val();
  if (searchText != "") {
    pdcResultCompany.style.display = "flex";
    $.ajax({
      url: "http://localhost/internarc/ajax/companySearchAdByCompany",
      method: "POST",
      data: {
        query: searchText,
        companyId: companyIdSearch,
      },
      success: function (response) {
        pdcResultCompany.innerHTML = response;
      },
    });
  } else {
    pdcResultCompany.style.display = "none";
  }
}

// Get references to the two input elements
var startInput = document.getElementById("internship_start");
var endInput = document.getElementById("internship_end");

// Add an event listener to the start input that sets the min attribute of the end input

if (startInput) {
  startInput.addEventListener("change", function () {
    endInput.min = startInput.value;
  });
}

//StdReq Search

//8.1 Student Request Search Company
let companySearchCompany = document.getElementById("company_search_stdreq");
let companyResultCompany = document.getElementById("company_stdreq_result");

if (companySearchCompany) {
  companySearchCompany.addEventListener("keyup", searchStdReqCompany);
}

function searchStdReqCompany() {
  let searchText = $(this).val();
  if (searchText != "") {
    companyResultCompany.style.display = "flex";
    $.ajax({
      url: "http://localhost/internarc/ajax/AdvertisementListRequests",
      method: "POST",
      data: {
        query: searchText,
      },
      success: function (response) {
        companyResultCompany.innerHTML = response;
      },
    });
  } else {
    companyResultCompany.style.display = "none";
  }
}

let companySearchShortListCompany = document.getElementById(
  "company_search_shortlist"
);
let companyShortlistResultCompany = document.getElementById(
  "company_shortlist_result"
);

if (companySearchShortListCompany) {
  companySearchShortListCompany.addEventListener(
    "keyup",
    searchStdShortlistCompany
  );
}

function searchStdShortlistCompany() {
  let searchText = $(this).val();
  if (searchText != "") {
    companyShortlistResultCompany.style.display = "flex";
    $.ajax({
      url: "http://localhost/internarc/ajax/AdvertisementShortlistListRequests",
      method: "POST",
      data: {
        query: searchText,
      },
      success: function (response) {
        companyShortlistResultCompany.innerHTML = response;
      },
    });
  } else {
    companyShortlistResultCompany.style.display = "none";
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

function confirmDelete(event) {
  event.preventDefault(); // Prevent the default behavior of the link

  if (confirm("Are you sure you want to delete?")) {
    window.location.href = event.target.href; // Proceed with the delete action
  }
}
