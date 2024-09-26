
// Form validation function

function validateRegisterForm() {
    const emailBox = document.querySelector("input#email");
    const passwordBox = document.querySelector("input#password");
    const confirmPasswordBox = document.querySelector("input#confirm_password");
    const email = document.querySelector("input#email").value;
    const password = document.querySelector("input#password").value;
    const confirmPassword = document.querySelector("input#confirm_password").value;
    const errorMessageEmail = document.querySelector("div#error-email");
    const errorMessagePassword = document.querySelector("div#error-password");
    const errorMessageConfirm = document.querySelector("div#error-confirm");

    // Regexes for  validation 
    const passwordCriteria = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; // At least 8 characters, one upper, one lower, one number, one special character
    const emailCriteria = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/ // Typical email format

    // Clear previous error messages and error classes
    errorMessageEmail.innerText = "";
    errorMessagePassword.innerText = "";
    errorMessageConfirm.innerText = "";
    emailBox.classList.remove("error-input");
    passwordBox.classList.remove("error-input");
    confirmPasswordBox.classList.remove("error-input");


    if (!email.match(emailCriteria)) {
        errorMessageEmail.innerText = "Wrong email format.";
        emailBox.classList.add("error-input");
        return false;
    }
    // Validate password criteria
    if (!password.match(passwordCriteria)) {
        errorMessagePassword.innerText = "Password must be at least 8 characters long, contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.";
        passwordBox.classList.add("error-input");
        return false;
    }

    // Validate password match
    if (password !== confirmPassword) {
        errorMessageConfirm.innerText = "Passwords do not match.";
        confirmPasswordBox.classList.add("error-input");
        return false;
    }

    return true; // Form is valid
}


// Validate Registration Form
const registerForm = document.querySelector("form#register");
registerForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const isValid = await validateRegisterForm();
    if(isValid) {
        registerForm.submit();
    }
});
