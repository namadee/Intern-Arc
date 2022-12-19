

function Validate(emailText, passText)
{
let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
let passwordPattern = /(?=.*[a-z])(?=.*[A-Z]).{6,}/;
if(emailText.value.match(mailformat))
{
    document.reg_form.email.focus();
    if(!passText.value.match(passwordPattern)){
        document.getElementById('validate-msg').innerHTML = "Password must contain atleast one lower class letter one upperclass letter and 6 characters";
        document.reg_form.password.focus();
        return false;
    }else{
        document.getElementById('validate-msg').innerHTML = " ";
        document.reg_form.password.focus();
        return true;
    }
}
else
{
    document.getElementById('validate-msg').innerHTML = "Enter a valid Email";
    document.reg_form.email.focus();
    if(!passText.value.match(passwordPattern)){
        document.getElementById('validate-msg').innerHTML = "Password must contain atleast one lower class letter one upperclass letter and 6 characters";
        document.reg_form.password.focus();
        return false;
    }else{
        document.getElementById('validate-msg').innerHTML = " ";
        document.reg_form.password.focus();
        return true;
    }
}

}

