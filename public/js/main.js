
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

/*set date input limits*/
function addMonths(date, months) {
  var d = date.getDate();
  date.setMonth(date.getMonth() + +months);
  if (date.getDate() != d) {
    date.setDate(0);
  }
  return date;
}
// const start_date = new Date();


document.getElementById("internship_start").min = new Date().toISOString().split("T")[0];

let start_date = document.getElementById("internship_start").valueAsDate.toISOString().split("T")[0];
let end_date = new Date(start_date.setMonth(start_date.getMonth()+6));
document.getElementById("internship_end").max = end_date.toISOString().split("T")[0];


// let end_date = start_date.addMonths(6);
// if(end_date)
console.log(start_date);
console.log(end_date);



