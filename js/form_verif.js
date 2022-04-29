let form = document.querySelector('#contactForm');

//Validation a chaque changement
form.ContactDate.addEventListener('change', function(){
    validContactDate(this);
});

form.BirthDate.addEventListener('change', function(){
    validContactDate(this);
});

form.firstName.addEventListener('change', function(){
    validFirstName(this);
});

form.lastName.addEventListener('change', function(){
    validLastName(this);
});

form.Email.addEventListener('change', function(){
    validEmail(this);
});

form.Object.addEventListener('change', function(){
    validObject(this);
});

form.Content.addEventListener('change', function(){
    validContent(this);
});

//Validation a l'envoie
form.addEventListener('submit', function(e) {
    e.preventDefault();
    if(validContent(form.Content) && validEmail(form.Email) && validFirstName(form.firstName) && validLastName(form.lastName) && validObject(form.Object) && validBirthDate(form.BirthDate) && validContactDate(form.ContactDate)) {
        console.log("oui");
        form.submit();
    }
})


//Fonction de validation
const validContactDate = function(inputCDate) {
    let small = inputCDate.nextElementSibling;
    let max = new Date(inputCDate.max);
    let now = new Date(inputCDate.value);
    if (inputCDate == "" || max<now ) {
        inputCDate.style.border = "solid 1px red";
        small.innerHTML = "Enter a valid date";
        return false;
    } else {
        inputCDate.style.border = "none";
        small.innerHTML = "";
        return true;
    }
}

const validBirthDate = function(inputBDate) {
    let small = inputBDate.nextElementSibling;
    let max = new Date(inputBDate.max);
    let now = new Date(inputBDate.value);
    if (inputBDate == "" || max<now) {
        inputBDate.style.border = "solid 1px red";
        small.innerHTML = "Enter a date";
        return false;
    } else {
        inputBDate.style.border = "none";
        small.innerHTML = "";
        return true;
    }
}

const validLastName = function(inputLName) {
    let nameRegex = /\d+/;
    let small = inputLName.nextElementSibling;
    if(nameRegex.test(inputLName.value) || inputLName == "") {
        inputLName.style.border = "solid 1px red";
        small.innerHTML = 'Enter a correct firstName (no number allowed)';
        return false;
    } else {
        inputLName.style.border = "none";
        small.innerHTML = "";
        return true;
    }
}

const validFirstName = function(inputFName) {
    let nameRegex = /\d+/;
    let small = inputFName.nextElementSibling;
    if(nameRegex.test(inputFName.value) || inputFName == "") {
        inputFName.style.border = "solid 1px red";
        small.innerHTML = 'Enter a correct lastName (no number allowed)';
        return false;
    } else {   
        inputFName.style.border = "none";
        small.innerHTML = "";
        return true;
    }
}
const validEmail = function(inputEmail) {
    let nameRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let small = inputEmail.nextElementSibling;
    if(!nameRegex.test(inputEmail.value) || inputEmail == "") {
        inputEmail.style.border = "solid 1px red";
        small.innerHTML = 'Enter a valid Email (example@gmail.com)';
        return false;
    } else {
        inputEmail.style.border = "none";
        small.innerHTML = "";
        return true;
    }
}

const validObject = function(inputObject) {
    let small = inputObject.nextElementSibling;
    if(inputObject.value == "") {
        inputObject.style.border = "solid 1px red";
        small.innerHTML = 'Enter the mail object';
        return false;
    } else {
        inputObject.style.border = "none";
        small.innerHTML = "";
        return true;
    }
}

const validContent = function(inputContent) {
    let small = inputContent.nextElementSibling;
    if(inputContent.value == "") {
        inputContent.style.border = "solid 1px red";
        small.innerHTML = 'Enter the mail object';
        return false;
    } else {
        inputContent.style.border = "none";
        small.innerHTML = "";
        return true;
    }
}

//Limitation des dates
var today = new Date();
var day = today.getDate();
var month = today.getMonth() + 1;
var years = today.getFullYear();

if (day < 10) 
	day = '0'+day;

if (month < 10) 
	month = '0'+month;

today = years+'-'+month+'-'+day;
document.getElementById("BirthDate").max = today;

today = new Date();
month = today.getMonth() + 2;
if (month == "13") {
	month = "01";
	years++;
}
if (month < 10) {
	month = '0'+month;
}
today = years+'-'+month+'-'+day;
document.getElementById("ContactDate").max = today;