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
let companyIdSearch = pdcSearchCompany.getAttribute("data-company-id");

if (pdcSearchCompany) {
  pdcSearchCompany.addEventListener("keyup", searchCompanyPdc);
}

function searchCompanyPdc() {
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
