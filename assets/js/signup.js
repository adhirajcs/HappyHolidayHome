function validateForm() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    // Validate Name
    if (name === "") {
        alert("Please enter your name.");
        return false;
    }

    // Validate Email
    var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!email.match(emailRegex)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Validate Phone Number
    var phoneRegex = /^[0-9]{10}$/;
    if (!phone.match(phoneRegex)) {
        alert("Please enter a valid 10-digit phone number.");
        return false;
    }

    // Validate Password
    if (password === "") {
        alert("Please enter a password.");
        return false;
    }

    // Validate Confirm Password
    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }

    return true;
}
