
//Toggle function of side bar
function toggleNav() {
  document.getElementById("nav").classList.toggle("toggle-sidenavbar");
  document.getElementById("topnav").classList.toggle("toggle-topnavbar");
  document.getElementById("main").classList.toggle("toggle-main");
  document.getElementById("toggle-nav-logo").classList.toggle("nav-logo-show");
  document.getElementById("top-nav-left").classList.toggle("top-nav-left");

}


//   if (typeof(localStorage) !== "undefined") {
//     console.log(' have local storage');
//   } else {
//     // Sorry! No Web Storage support..
//   }


//Temparary SIDEBAR ITEMS
window.onload = function navigationPDC() {
    
  let pdcMenu = [
    ["#", "dashboard", "Dashboard"],
    ["#", "contact_phone", "Manage Company"],
    ["#", "school", "Manage Student"],
    ["#", "work", "Job Roles"],
    ["#", "text_to_speech", "Advertisements"],
    ["#", "compare_arrows", "Requests"],
    ["#", "manage_accounts", "Profile"],
  ];

  for (let i = 0; i < pdcMenu.length; i++) {
    // get the size of the inner array
    // loop the inner array
    document.getElementById("navbarItems").innerHTML +=
      ` <li>
        <a href="` +
      pdcMenu[i][0] +
      `">
            <span class="material-symbols-rounded">
            ` +
      pdcMenu[i][1] +
      `
            </span>
            <p>` +
      pdcMenu[i][2] +
      `</p>
        </a>
    </li>`;
  }
};