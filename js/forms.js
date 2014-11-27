function formhash(form, password) {
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
 
    // Finally submit the form. 
    form.submit();
}
 
function regformhash(form, uid, email, password, conf, firstname, lastname) {
     // Check each field has a value
    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == ''|| 
          firstname.value == ''|| 
          lastname.value == '') {
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
 
 	re = /^\w+$/; 
    if(!re.test(form.firstname.value)) { 
        alert("First name must contain only letters and numbers. Please try again"); 
        form.firstname.focus();
        return false; 
    }
	
	re = /^\w+$/; 
    if(!re.test(form.lastname.value)) { 
        alert("Last name must contain only letters and numbers. Please try again"); 
        form.lastname.focus();
        return false; 
    }
 
    // Check the username
 
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        alert("Username must contain only letters and numbers. Please try again"); 
        form.username.focus();
        return false; 
    }
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }
 
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }
 
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";
 
    // Finally submit the form. 
    form.submit();
    return true;
}

function passformhash(form, uID, password, newpassword, conf) {
     // Check each field has a value
    if ( password.value == ''  || 
	newpassword.value == '' || conf.value == ''
          ) {
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (newpassword.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(newpassword.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }
 
    // Check password and confirmation are the same
    if (newpassword.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }
 
	var op = document.createElement("input"); 
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
	
	form.appendChild(op);
    op.name = "op";
    op.type = "hidden";
    op.value = hex_sha512(password.value);
 
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(newpassword.value);
 
    // Make sure the plaintext password doesn't get sent.
	password.value = ""; 
    newpassword.value = "";
    conf.value = "";
 
    // Finally submit the form. 
    form.submit();
    return true;
}