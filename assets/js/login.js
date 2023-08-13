// login-validation.js
function validateLoginForm() {
    var email = document.getElementById("loginEmail").value;
    var password = document.getElementById("loginPassword").value;

    // Validate Email
    var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!email.match(emailRegex)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Validate Password
    if (password === "") {
        alert("Please enter a password.");
        return false;
    }

    return true;
}
