//Toggle function of side bar
function toggleNav() {
  document.getElementById("nav").classList.toggle("toggle-sidenavbar");
  document.getElementById("topnav").classList.toggle("toggle-topnavbar");
  document.getElementById("main").classList.toggle("toggle-main");
  document.getElementById("toggle-nav-logo").classList.toggle("nav-logo-show");
  document.getElementById("top-nav-left").classList.toggle("top-nav-left");
}

//Toggle Password Visibility Function
const toggleIcon1 = document.getElementById("togglePasswordIcon1");
const passwordField1 =document.getElementById('password');
const passwordField2 =document.getElementById('confirm_password');

if (toggleIcon1) {
  toggleIcon1.addEventListener("click", togglePasswordVisibility);
}

function togglePasswordVisibility() {

  if (passwordField1.type === "password") {
    passwordField1.type = "text";
    passwordField2.type = "text";
    toggleIcon1.textContent = 'visibility_off';
  } else {
    passwordField1.type = "password";
    passwordField2.type = "password";
    toggleIcon1.textContent = 'visibility';
  }
}

//Validate Passwords
const updatePwdForm = document.querySelector(".update-pwd-container form");
const validateError = document.getElementById("pwd-validate-error");
if (updatePwdForm) {
  updatePwdForm.addEventListener("submit", checkConfirmPassword);
}

const specialChar = new RegExp("(?=.*[!@#$%^&*])");
const upperCase = new RegExp("(?=.*[A-Z])");

function checkConfirmPassword(event) {
  const passwordInput = document.getElementById("password").value;
  const confirmPasswordInput =
    document.getElementById("confirm_password").value;

  if (!specialChar.test(passwordInput) && upperCase.test(passwordInput)) {
    console.log("Special char Not found and Have Uppercase");
    if (passwordInput != confirmPasswordInput) {
      event.preventDefault();
      validateError.textContent = "Password Does Not Match";
      validateError.style.display = "block";
    }
  } else {
    console.log("Special char found or No UpperCase");
    event.preventDefault();
    validateError.textContent =
      "Password Must contain atleast 1 Uppercase Letter and No any Special Characters";
    validateError.style.display = "block";
  }
}

/*set date input limits*/
function addMonths(date, months) {
  var d = date.getDate();
  date.setMonth(date.getMonth() + +months);
  if (date.getDate() != d) {
    date.setDate(0);
  }
  return date;
}
// const start_date = new Date();

document.getElementById("internship_start").min = new Date()
  .toISOString()
  .split("T")[0];

let start_date = document
  .getElementById("internship_start")
  .valueAsDate.toISOString()
  .split("T")[0];
let end_date = new Date(start_date.setMonth(start_date.getMonth() + 6));
document.getElementById("internship_end").max = end_date
  .toISOString()
  .split("T")[0];

// let end_date = start_date.addMonths(6);
// if(end_date)
console.log(start_date);
console.log(end_date);

function toggleProfileUpdate() {
  let updateBtn = document.getElementById("toggleUpdateBtn");

  if (updateBtn.style.display === "none") {
    updateBtn.style.display = "block";
  } else {
    updateBtn.style.display = "none";
  }
}
