var validateFormClass = function(elemClass, messageClass, messageErr) {
	 this.elemClass = elemClass;
	 this.messageClass  = messageClass;
	 this.messageErr = messageErr;
}

validateFormClass.prototype.checkEmail = function() {
	var regexpr = /^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/;
	var emailResult = regexpr.test(this.elemClass.value);
	if(!emailResult){
		this.messageClass.innerHTML = this.messageErr;
		return false;
	}
	else {
		this.messageClass.innerHTML = "";
		return true;
	}
};

validateFormClass.prototype.checkEmpty = function() {
	if (this.elemClass.value == null || this.elemClass.value == "") {
		this.messageClass.innerHTML = this.messageErr;
		return true;
	}
	else {
		this.messageClass.innerHTML = "";
		return false;
	}
};

validateFormClass.prototype.isNumber = function() {
	if (isNaN(this.elemClass.value)) {
		this.messageClass.innerHTML = this.messageErr;
		return true;
	}
	else {
		this.messageClass.innerHTML = "";
		return false;
	}
};

validateFormClass.prototype.isChar = function() {
	if (!isNaN(this.elemClass.value)) {
		this.messageClass.innerHTML = this.messageErr;
		return true;
	}
	else {
		this.messageClass.innerHTML = "";
		return false;
	}
};

validateFormClass.prototype.maxLen = function(m) {
	this.max = m;
	if (this.elemClass.value.length >= this.max && this.elemClass.value.length <= this.max) {
		this.messageClass.innerHTML = "";
		return true;
	} else {
		this.messageClass.innerHTML = this.messageErr;
		return false;
	}
};


function validateForm() {
    var noError = true;

    var nameInput = document.getElementsByClassName('nameInput');
    var nameInputError = document.getElementsByClassName('nameInputError');
    for (var i=0; i< nameInput.length; i++) {
    //for(var i in nameInput) {
	    var validatorName = new validateFormClass(nameInput[i], nameInputError[i], '');
	    validatorName.messageErr = "Name field is required.";
	    if(!validatorName.checkEmpty()) {
	    	validatorName.messageErr = "Invalid name.";
	        if(!validatorName.isChar()) {
		        noError = false;
		    }
	    }
	    else {
	        noError = false;
	    }
	}

    
    var emailInput = document.getElementsByClassName('emailInput');   
    var emailInputError = document.getElementsByClassName('emailInputError');
    for (var i=0; i< emailInput.length; i++) {
	    var validatorEmail = new validateFormClass(emailInput[i], emailInputError[i],'');
	    validatorEmail.messageErr = "Email field is required.";
	    if(!validatorEmail.checkEmpty()) {
	        validatorEmail.messageErr = "Invalid email.";
	        if(validatorEmail.checkEmail()) {
	            noError = false;
	        }
	    }
	    else {
	        noError = false;
	    }
	}

    var contactInput = document.getElementsByClassName('contactInput');
    var contactInputError = document.getElementsByClassName('contactInputError');
    for (var i=0; i< contactInput.length; i++) {
	    var validatorContact = new validateFormClass(contactInput[i], contactInputError[i], '');
	    validatorContact.messageErr = "Contact Number field is required.";
	    if(!validatorContact.checkEmpty()) {
	        validatorContact.messageErr = "Invalid number.";
	        if(!validatorContact.isNumber()) {
	            validatorContact.messageErr = "Length must less than 10 charaters.";
		        if(!validatorContact.maxLen(10)) {
		            noError = false;
		        }    
	        }
	    }
	    else {
	        noError = false;
	    }
	}
}

function subForm() {
	var forms = document.getElementsByTagName('form');
	forms.submitForm.submit();
}

function addMore() {
	var element = document.getElementById('cloneDiv');
	var	_clone = element.cloneNode(true);
	_clone.removeAttribute('id','cloneDiv');
	_clone.classList.add('removeDiv');
	var removeButton = 'Contact <button type="button" class="btn close" onclick="removeForm(this)">Remove</button>';
	_clone.getElementsByClassName('card-title')[0].innerHTML = removeButton;
	var classValue = _clone.getElementsByClassName('form-control');
	for (let i=0; i < classValue.length; i++) {
	    classValue[i].value = '';
	    _clone.getElementsByClassName('errormess')[i].innerHTML = '';
	}
	document.getElementById('form').append(_clone);
};

function removeForm(element) {
	var el = element.closest('.removeDiv');
  	el.remove();
  	//subForm();
}