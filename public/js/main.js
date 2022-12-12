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


// validate email and password

var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");


// (?=.*[a-z])	The string must contain at least 1 lowercase alphabetical character
// (?=.*[A-Z])	The string must contain at least 1 uppercase alphabetical character
// (?=.*[0-9])	The string must contain at least 1 numeric character
// (?=.*[!@#$%^&*])	The string must contain at least one special character, but we are escaping reserved RegEx characters to avoid conflict
// (?=.{8,})	The string must be eight characters or longer

// const isPasswordSecure = (password) => {
//   const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
//   return re.test(password);
// };

