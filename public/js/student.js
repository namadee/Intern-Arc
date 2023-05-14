const interestAreas = document.getElementById("add-interest-area");
const addInterestBtn = document.getElementById("add-interest-icon");
const deleteBtn = document.getElementById("delete-interest-icon");
const addExpBtn = document.getElementById("addExpIcon");
const expAreas = document.getElementById("add-exp-area");

addInterestBtn.addEventListener("click", function () {
  const interestAreaInput = document.createElement("input");
  interestAreaInput.setAttribute("type", "text");
  interestAreaInput.setAttribute("name", "interests[]");
  interestAreaInput.classList.add("interest-area");
  interestAreaInput.classList.add("common-input");
  interestAreaInput.setAttribute("style", "margin: 0.3rem;");
  interestAreas.appendChild(interestAreaInput);
});

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


const qualificationArea = document.getElementById("add-qualification-area");
const addQualificationBtn = document.getElementById("addQualificationIcon");


addQualificationBtn.addEventListener("click", function () {
  const qualificationAreaInput = document.createElement("textarea");
  qualificationAreaInput.setAttribute("type", "text");
  qualificationAreaInput.setAttribute("name", "qualifications[]");
  qualificationAreaInput.setAttribute("cols", "10");
  qualificationAreaInput.setAttribute("rows", "3");
  qualificationAreaInput.setAttribute("style", "margin: 0.3rem; resize: none;");
  qualificationAreaInput.classList.add("common-input");
  qualificationAreaInput.classList.add("qualification-area");
  qualificationArea.appendChild(qualificationAreaInput);
});

const extracurricularArea = document.getElementById("add-extracurricular-area");
const addExtracurricularBtn = document.getElementById("addeExtracurricularIcon");


addExtracurricularBtn.addEventListener("click", function () {
  const extraAreaInput = document.createElement("textarea");
  extraAreaInput.setAttribute("type", "text");
  extraAreaInput.setAttribute("name", "extracurricular[]");
  extraAreaInput.setAttribute("cols", "10");
  extraAreaInput.setAttribute("rows", "3");
  extraAreaInput.setAttribute("style", "margin: 0.3rem; resize: none;");
  extraAreaInput.classList.add("common-input");
  extraAreaInput.classList.add("extracurricular-area");
  extracurricularArea.appendChild(extraAreaInput);
});