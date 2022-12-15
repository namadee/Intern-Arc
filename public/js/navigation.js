window.addEventListener("DOMContentLoaded", function () {

  const pdcMenu = [
    ["#", "dashboard", "Dashboard"],
    ["#", "cases", "Companies"],
    ["#", "school", "Students"],
    ["#", "category", "Job Roles"],
    ["#", "text_to_speech", "Advertisements"],
    ["#", "compare_arrows", "Requests"],
    ["#", "manage_accounts", "Profile"],
  ];

  const companyMenu = [
    ["company/dashboard", "dashboard", "Dashboard"],
    ["advertisements", "text_to_speech", "Advertisements"],
    ["studentRequests", "school", "Student Requests"],
    ["StudentShortlist", "list_alt", "Shortlisted"],
    ["#", "calendar_month", "Schedule"],
    ["#", "approval_delegation", "Complaint"],
    ["company/profile", "manage_accounts", "Profile"],
  ];

  const studentMenu = [
    ["#", "dashboard", "Dashboard"],
    ["#", "cases", "Company"],
    ["#", "manage_accounts", "Profile"],
    ["#", "text_to_speech", "Advertisements"],
    ["#", "approval_delegation", "Complaint"],
    ["#", "calendar_month", "Schedule"],
  ];

  const adminMenu = [
    ["#", "dashboard", "Dashboard"],
    ["#", "cases", "Company"],
    ["#", "school", "Student"],
    ["#", "groups", "PDC"],
    ["#", "text_to_speech", "Advertisements"],
    ["#", "approval_delegation", "Complaint"],
    ["#", "monitoring", "Reports"],
    ["#", "manage_accounts", "Profile"],
  ];

  let navigationMenu = sessionStorage.getItem("navSidebar"); //Getting the value stored in the session storage


  //Selecting Navigation based On User Role which is got from the session
  function getNavigationMenu(navigationMenu) {
    switch (navigationMenu) {
      case "pdc":
        getNavbarItems(pdcMenu);
        break;

      case "student":
        getNavbarItems(studentMenu);
        break;

      case "company":
        getNavbarItems(companyMenu);
        break;

      default:
        getNavbarItems(adminMenu);
        break;

    }
  }

  //Print Menu items
  function getNavbarItems(navigationMenu) {
    for (let i = 0; i < navigationMenu.length; i++) {
      // get the size of the inner array
      // loop the inner array
      document.getElementById("navbarItems").innerHTML +=
        ` <li>
          <a href="` + navigationMenu[i][0] + `">
              <span class="material-symbols-rounded"> ` + navigationMenu[i][1] + `
              </span>
              <p>` + navigationMenu[i][2] + `</p>
          </a>
      </li>`;
    }
  }


  getNavigationMenu(navigationMenu); //Calling the function
  
});
