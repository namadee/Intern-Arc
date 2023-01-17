


var password = "123456"; 

if(password.length < 8) { 

console.log("Password must be at least 8 characters"); 

}

function ValidateEmail(inputText)
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(inputText.value.match(mailformat))
{
alert("Valid email address!");
document.reg_form.email.focus();
return true;
}
else
{
alert("You have entered an invalid email address!");
document.reg_form.email.focus();
return false;
}
}
