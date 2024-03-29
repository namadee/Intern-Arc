const interestAreas = document.getElementById("add-interest-area");
const addInterestBtn = document.getElementById("add-interest-icon");
const deleteBtn = document.getElementById("delete-interest-icon");

if (addInterestBtn) {
  addInterestBtn.addEventListener("click", function () {
    const interestAreaInput = document.createElement("input");
    interestAreaInput.setAttribute("type", "text");
    interestAreaInput.setAttribute("name", "interests[]");
    interestAreaInput.classList.add("interest-area");
    interestAreaInput.classList.add("common-input");
    interestAreaInput.setAttribute("style", "margin: 0.3rem;");
    interestAreas.appendChild(interestAreaInput);
  });
}

const addExpBtn = document.getElementById("addExpIcon");
const expAreas = document.getElementById("add-exp-area");

if (addExpBtn) {
  addExpBtn.addEventListener("click", function () {
    const expAreaInput = document.createElement("textarea");
    expAreaInput.setAttribute("type", "text");
    expAreaInput.setAttribute("name", "experiences[]");
    expAreaInput.setAttribute("cols", "10");
    expAreaInput.setAttribute("rows", "3");
    expAreaInput.setAttribute("style", "margin: 0.3rem; resize: none;");
    expAreaInput.classList.add("common-input");
    expAreaInput.classList.add("experience-area");
    expAreas.appendChild(expAreaInput);
  });
}

const qualificationArea = document.getElementById("add-qualification-area");
const addQualificationBtn = document.getElementById("addQualificationIcon");

if (addQualificationBtn) {
  addQualificationBtn.addEventListener("click", function () {
    const qualificationAreaInput = document.createElement("textarea");
    qualificationAreaInput.setAttribute("type", "text");
    qualificationAreaInput.setAttribute("name", "qualifications[]");
    qualificationAreaInput.setAttribute("cols", "10");
    qualificationAreaInput.setAttribute("rows", "3");
    qualificationAreaInput.setAttribute(
      "style",
      "margin: 0.3rem; resize: none;"
    );
    qualificationAreaInput.classList.add("common-input");
    qualificationAreaInput.classList.add("qualification-area");
    qualificationArea.appendChild(qualificationAreaInput);
  });
}

const extracurricularArea = document.getElementById("add-extracurricular-area");
const addExtracurricularBtn = document.getElementById(
  "addeExtracurricularIcon"
);

if (addExtracurricularBtn) {
  addExtracurricularBtn.addEventListener("click", function () {
    const extraAreaInput = document.createElement("textarea");
    extraAreaInput.setAttribute("type", "text");
    extraAreaInput.setAttribute("name", "extracurricular[]");
    extraAreaInput.setAttribute("cols", "10");
    extraAreaInput.setAttribute("rows", "2");
    extraAreaInput.setAttribute("style", "margin: 0.3rem; resize: none;");
    extraAreaInput.classList.add("common-input");
    extraAreaInput.classList.add("extracurricular-area");
    extracurricularArea.appendChild(extraAreaInput);
  });
}

// Showing upload file name
const uploadFileName = document.getElementById("form-file-name");
const studentCV = document.getElementById("myCvFile");

if (studentCV) {
  studentCV.addEventListener("change", showFileName);
}

function showFileName(event) {
  let filename = event.srcElement.files[0].name;
  uploadFileName.textContent = filename;
}

const jobRoleSelectForm = document.getElementById("job-role-select-form");

if (jobRoleSelectForm) {
  jobRoleSelectForm.addEventListener("submit", validateForm);
}

//Only 3 Job roles selected

function validateForm(event) {
  // Get all the checkboxes
  let checkboxes = document.querySelectorAll('input[type="checkbox"]');

  // Count the number of checkboxes that are checked
  let checkedCount = 0;
  for (let i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      checkedCount++;
    }
  }

  // Make sure exactly 3 checkboxes are checked
  if (checkedCount === 3) {
    const confirmation = confirm(
      "Are you sure you want to submit with these job roles? You can't change this again."
    );

    if (!confirmation) {
      event.preventDefault(); // prevent form submission
    }
  } else {
    event.preventDefault(); // prevent form submission
    alert("Please select exactly 3 job roles.");
  }
}
