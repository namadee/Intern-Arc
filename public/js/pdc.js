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

// var current_year=new Date().getFullYear();
// if((year < 1920) || (year > current_year))

const stdBatchYrForm = document.getElementById("add-student-batch");
const batchYear = document.getElementById("batch-year-input");
const batchYrError = document.getElementById('validate-error');

if (stdBatchYrForm) {
  stdBatchYrForm.addEventListener("submit", batchYearValidate);
}

function batchYearValidate(event) {

  let currentYear = new Date().getFullYear();
  upperLimit = currentYear + 2;
  lowerLimit = currentYear - 5;

  if (batchYear.value.length != 4) {
    batchYrError.textContent = "*Please enter a valid Year!";
    event.preventDefault();
    return false;
  }


  if (batchYear.value < lowerLimit || batchYear.value > upperLimit) {
    batchYrError.textContent = "*Please enter a Year Beween " + lowerLimit + " and " + upperLimit;
    event.preventDefault();
    return false;
    }

}

//Display Update Button - Main Student Detail View

function toggleProfileUpdate() {
  let updateBtn = document.getElementById("toggleUpdateBtn");

  if (updateBtn.style.display === "none") {
    updateBtn.style.display = "block";
  } else {
    updateBtn.style.display = "none";
  }
}