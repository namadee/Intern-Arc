const interestAreas = document.getElementById("add-interest-area");
const addInterestBtn = document.getElementById("add-interest-icon");
const deleteBtn = document.getElementById("delete-interest-icon");
const addExpBtn = document.getElementById("addExpIcon");
const expAreas = document.getElementById("add-exp-area");

addInterestBtn.addEventListener('click', function(){
    const interestAreaInput = document.createElement("input");
    interestAreaInput.setAttribute("type", "text");
    interestAreaInput.setAttribute("name", "interests[]");
    interestAreaInput.classList.add("interest-area");
    interestAreas.appendChild(interestAreaInput);
    

});

addExpBtn.addEventListener('click', function(){
    const expAreaInput = document.createElement("textarea");
    expAreaInput.setAttribute("type", "text");
    expAreaInput.setAttribute("name", "experiences[]");
    expAreaInput.classList.add("experience-area");
    expAreas.appendChild(expAreaInput);
    

});
