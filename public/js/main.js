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

//Stop multiple submission of form (All the forms selected)
// const allForms = document.querySelectorAll("form");

// if (allForms) {
//   for (let i = 0; i < allForms.length; i++) {
//     allForms[i].addEventListener("submit", disableFormButton);
//   }
// }

// function disableFormButton(event) {
//   event.submitter.disabled = true;
// }

// function enableFormButton(event){
//   event.submitter.disabled = false;
// }
//*****Cant use this all Form function -> It clashes with form validations



// document.getElementById("internship_start").min = new Date().toISOString().split("T")[0];

// let start_date; // undefined
// let end_date_input;
// function add_months(dt, n) 
// {
//     return new Date(dt.setMonth(dt.getMonth() + n));      
// }

// document.getElementById("internship_start").addEventListener("change", function() {
//     start_date = this.valueAsDate; // Update newSelectedDate value.
//     end_date = add_months(start_date,5);
//     console.log(end_date.toISOString().split("T")[0]); // Now has a string.
//     console.log("end date" + end_date_input);
//     document.getElementById("internship_end").addEventListener("change", function () {
//         end_date_input = document.getElementById("internship_end").valueAsDate;
//         if(end_date_input > end_date)
//         {
//             console.log("invalid");
//         }
//     });
    
// });

//Upload image on edit profile
function displayImageName(fileName){
  var fileInfo = document.querySelector(".file-info").innerHTML = 'Selected file: <br>' + fileName;
}

//let end_date = new Date(start_date.setMonth(start_date.getMonth()+6));



