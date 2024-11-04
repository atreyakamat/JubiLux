function validateForm() {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;
    var passwordError = document.getElementById('passwordError');
    var confirmPasswordError = document.getElementById('confirmPasswordError');

    passwordError.textContent = '';
    confirmPasswordError.textContent = '';

    var passwordStrengthRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    
    if (!passwordStrengthRegex.test(password)) {
        passwordError.textContent = 'Password must be at least 8 characters, include an uppercase letter, lowercase letter, number, and special character.';
        return false;
    }

    if (password !== confirmPassword) {
        confirmPasswordError.textContent = 'Passwords do not match.';
        return false;
    }

    return true; 
}

