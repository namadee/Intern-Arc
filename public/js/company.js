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


let companySearchShortListCompany = document.getElementById("company_search_shortlist");
let companyShortlistResultCompany = document.getElementById("company_shortlist_result");

if (companySearchShortListCompany) {
  companySearchShortListCompany.addEventListener("keyup", searchStdShortlistCompany);
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
