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

if (companyCsvFile) {
  companyCsvFile.addEventListener("change", showFileName);
}

if (studentsCsvFile) {
  studentsCsvFile.addEventListener("change", showFileName);
}

function showFileName(event) {
  let filename = event.srcElement.files[0].name;
  uploadFileName.textContent = filename;
}

// 3. Stop Multiple Submissions - CSV Registration Forms & Student Registration Form

const csvRegistrationElement = document.getElementById('csvFormRegistration');
const studentRegFormElement = document.getElementById('student-register-form');

if(csvRegistrationElement){
  csvRegistrationElement.addEventListener('submit',preventMultipleSubmissions);
}

if(studentRegFormElement){
  studentRegFormElement.addEventListener('submit',preventMultipleSubmissions);
}

function preventMultipleSubmissions(event){
  event.submitter.disabled = true;
}

// 4. 
