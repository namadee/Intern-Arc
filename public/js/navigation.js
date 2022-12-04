window.addEventListener("DOMContentLoaded", function () {
  const pdcMenu = [
    ["#", "dashboard", "Dashboard"],
    ["#", "cases", "Manage Company"],
    ["#", "school", "Manage Student"],
    ["#", "category", "Job Roles"],
    ["#", "text_to_speech", "Advertisements"],
    ["#", "compare_arrows", "Requests"],
    ["#", "manage_accounts", "Profile"],
  ];

  const companyMenu = [
    ["#", "dashboard", "Dashboard"],
    ["#", "text_to_speech", "Advertisements"],
    ["#", "school", "Student Requests"],
    ["#", "list_alt", "Shortlisted"],
    ["#", "calendar_month", "Schedule"],
    ["#", "approval_delegation", "Comlpaint"],
    ["#", "manage_accounts", "Profile"],
  ];

  const studentMenu = [
    ["#", "dashboard", "Dashboard"],
    ["#", "cases", "Company"],
    ["#", "manage_accounts", "Profile"],
    ["#", "text_to_speech", "Advertisements"],
    ["#", "approval_delegation", "Comlpaint"],
    ["#", "calendar_month", "Schedule"],
  ];

  const adminMenu = [
    ["#", "dashboard", "Dashboard"],
    ["#", "cases", "Company"],
    ["#", "school", "Student"],
    ["#", "groups", "PDC"],
    ["#", "text_to_speech", "Advertisements"],
    ["#", "approval_delegation", "Comlpaint"],
    ["#", "monitoring", "Reports"],
    ["#", "manage_accounts", "Profile"],
  ];

  getNavigationMenu(navigationMenu); //Calling the function

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
});

// window.onload = function navigationPDC() {

//     let pdcMenu = [
//       ["#", "dashboard", "Dashboard"],
//       ["#", "contact_phone", "Manage Company"],
//       ["#", "school", "Manage Student"],
//       ["#", "work", "Job Roles"],
//       ["#", "text_to_speech", "Advertisements"],
//       ["#", "compare_arrows", "Requests"],
//       ["#", "manage_accounts", "Profile"],
//     ];

//     for (let i = 0; i < pdcMenu.length; i++) {
//       // get the size of the inner array
//       // loop the inner array
//       document.getElementById("navbarItems").innerHTML +=
//         ` <li>
//           <a href="` +
//         pdcMenu[i][0] +
//         `">
//               <span class="material-symbols-rounded">
//               ` +
//         pdcMenu[i][1] +
//         `
//               </span>
//               <p>` +
//         pdcMenu[i][2] +
//         `</p>
//           </a>
//       </li>`;
//     }
//   };
