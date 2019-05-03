//makes sure the input for a new account is valid.
function validateNewAccount() 
{
    //is the email valid?
    var email = document.forms["newAccount"]["email"].value;
    if (isValidEmail(email) == false) {document.getElementById("err").innerHTML = "Invalid email."; return false; }
    
    //is there white space in the username?
    var username = document.forms["newAccount"]["username"].value;
    if (hasWhiteSpace(username) == false) 
    {
    	document.getElementById("err").innerHTML = "Invalid username. Username must have no spaces.";
    	return false; 
    }
    
	//do the passwords match?
	if (!passwordsMatch("newAccount", "password", "confirmpassword")) 
	{ 
		document.getElementById("err").innerHTML = "Passwords do not match."; 
		return false; 
	}
	
	//is the password at least 8 characters long?
	var password = document.forms["newAccount"]["password"].value;
	if (password.length < 8) { document.getElementById("err").innerHTML = "Password must be at least 8 characters long."; return false; }
	
	//does the password have whitespace?
	if (hasWhiteSpace(password) == false) 
    {
    	document.getElementById("err").innerHTML = "Invalid password. Password must have no spaces.";
    	return false; 
    }
	
	return true;
}

//confirm that both passwords match.
function verifyOnePassword()
{
	//do the passwords match
	if (!passwordsMatch("deleteAccount", "password", "confirmpassword")) 
	{ 
		document.getElementById("err").innerHTML = "Passwords do not match."; 
		return false; 
	}

	return true;
}

//verify two passwords (comfirm that both old passwords match, and that both new passwords match and are valid)
function verifyPasswords()
{
	//do the old passwords match?
	if (!passwordsMatch("changePassword", "oldpassword", "confirmoldpassword")) 
	{ 
		document.getElementById("err").innerHTML = "Old passwords do not match."; 
		return false; 
	}	
	
	//do the new passwords match?
	if (!passwordsMatch("changePassword", "newpassword", "confirmnewpassword")) 
	{ 
		document.getElementById("err").innerHTML = "New passwords do not match."; 
		return false; 
	}
	
	//is the new password at least 8 characters long?
	var newPassword = document.forms["changePassword"]["newpassword"].value;
	if (newPassword.length < 8) { document.getElementById("err").innerHTML = "The new password must be at least 8 characters long."; return false; }
	
	//does the new password have white space?
	if (hasWhiteSpace(newPassword) == false) 
    {
    	document.getElementById("err").innerHTML = "New password is invalid. New password must have no spaces.";
    	return false; 
    }
	
	return true;
}

//is email properly formatted?
function isValidEmail(email) 
{
    var isValid = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
    
    if (!isValid) { return false; }
}

//does a string have white space?
function hasWhiteSpace(str)
{
	
	if (str.indexOf(' ') > -1) { return false; }
	
	return true;
}

//make sure that entered username/email doesnt have any white space when logging in.
function validateLogin()
{
	var usernameOrEmail = document.forms["login"]["usernameoremail"].value;
    if (hasWhiteSpace(usernameOrEmail) == false) {document.getElementById("err").innerHTML = "Username/Email must contain no white space."; return false; }
    
    return true;
}


//do the given passwords match?
function passwordsMatch(formid, password, passwordConfirm)
{
	var password = document.forms[formid][password].value;
	var passwordConfirm = document.forms[formid][passwordConfirm].value;
	if (password == passwordConfirm) { return true; }
	
	return false;
}