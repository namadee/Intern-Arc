//Register Company Page Validation

// 1. Contact Number
const contactNumElement = document.querySelector('.register-company-item .contact');
const validateMsgElement = document.getElementById('input-contact-error');
const registerCompanyFormElement = document.querySelector('.register-company form');
if (registerCompanyFormElement) {
    registerCompanyFormElement.addEventListener('submit', validateContact);
}

function validateContact(event){
    const contact = contactNumElement.value;
    if (contact.length != 10) {
        validateMsgElement.textContent = '*Contact must have 10 numbers!';
        event.preventDefault();
    }
    else{
        validateMsgElement.textContent = '';
    }
}

//