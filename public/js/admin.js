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
const changePwdForm =  document.getElementById("change_password_pdc");
const ChangePasswordValidateError = document.getElementById("changePwd_validate_error");
if (changePwdForm) {
  changePwdForm.addEventListener("submit", checkConfirmPasswordFunction);
}

const specialCharFormat = new RegExp("(?=.*[!@#$%^&*])");
const upperCaseFormat = new RegExp("(?=.*[A-Z])");

function checkConfirmPasswordFunction(event) {
  const passwordInput = document.getElementById("user_new_password").value;
  const confirmPasswordInput =
    document.getElementById("user_confirm_password").value;

  if (specialCharFormat.test(passwordInput) && upperCaseFormat.test(passwordInput)) {
    console.log("Special char found and Have Uppercase");
    if (passwordInput != confirmPasswordInput) {
      event.preventDefault();
      ChangePasswordValidateError.textContent = "The Confirm Password does not match";
      ChangePasswordValidateError.style.display = "block";
    }
  } else {
    event.preventDefault();
    ChangePasswordValidateError.textContent =
      "The New Password must contain atleast 1 Uppercase Letter and any Special Character";
      ChangePasswordValidateError.style.display = "block";
  }
}