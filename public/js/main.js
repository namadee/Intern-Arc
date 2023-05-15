//Toggle function of side bar
function toggleNav() {
  document.getElementById("nav").classList.toggle("toggle-sidenavbar");
  document.getElementById("topnav").classList.toggle("toggle-topnavbar");
  document.getElementById("main").classList.toggle("toggle-main");
  document.getElementById("toggle-nav-logo").classList.toggle("nav-logo-show");
  document.getElementById("top-nav-left").classList.toggle("top-nav-left");
}

//Toggle Password Visibility Function - Forgot Password functionality
const toggleIcon1 = document.getElementById("togglePasswordIcon1");
const passwordField1 = document.getElementById("password");
const passwordField2 = document.getElementById("confirm_password");

if (toggleIcon1) {
  toggleIcon1.addEventListener("click", togglePasswordVisibility);
}

function togglePasswordVisibility() {
  if (passwordField1.type === "password") {
    passwordField1.type = "text";
    passwordField2.type = "text";
    toggleIcon1.textContent = "visibility_off";
  } else {
    passwordField1.type = "password";
    passwordField2.type = "password";
    toggleIcon1.textContent = "visibility";
  }
}

//Validate Passwords
const updatePwdForm = document.getElementById("login_update_pwd_form");
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

  if (specialChar.test(passwordInput) && upperCase.test(passwordInput)) {
    console.log("Special char found and Have Uppercase");
    if (passwordInput != confirmPasswordInput) {
      event.preventDefault();
      validateError.textContent = "Password Does Not Match";
      validateError.style.display = "block";
    }
  } else {
    event.preventDefault();
    validateError.textContent =
      "Password Must contain atleast 1 Uppercase Letter and any Special Character";
    validateError.style.display = "block";
  }
}

//Upload image on edit profile
function displayImageName(fileName) {
  var fileInfo = (document.querySelector(".file-info").innerHTML =
    "Selected file: <br>" + fileName);
}

//let end_date = new Date(start_date.setMonth(start_date.getMonth()+6));


//LOGIN PAGE PASSWORD VISIBILITY
//Toggle Password Visibility Function - Login Password functionality
const toggleIconLoginForm = document.getElementById("toggleIconLoginForm");
const loginPasswordField = document.getElementById("login_password");

if (toggleIconLoginForm) {
  toggleIconLoginForm.addEventListener("click", togglePasswordVisibilityLoginPage);
}

function togglePasswordVisibilityLoginPage() {
  if (loginPasswordField.type === "password") {
    loginPasswordField.type = "text";
    toggleIconLoginForm.textContent = "visibility_off";
  } else {
    loginPasswordField.type = "password";
    toggleIconLoginForm.textContent = "visibility";
  }
}

notifIcon = document.getElementById("notfIcon");
//add event listener on click to notificon
if (notifIcon) {
  notifIcon.addEventListener("click", openNotifications);
}


//open notifications
function openNotifications() {
  console.log("clicked");
  document.getElementById("notification-list").classList.toggle("toggle-notification");
}