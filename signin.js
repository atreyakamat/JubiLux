window.onload = function() {
    var form = document.querySelector('form');
    var passwordInput = document.getElementById('password');
    var usernameInput = document.getElementById('username');

    form.onsubmit = function(event) {
        var errors = "";
       
        var username = usernameInput.value;
        if (username.length < 3) {
            errors += "Username must be at least 3 characters long.\n";
        }
        var password = passwordInput.value;
        if (password.length < 8) {
            errors += "Password must be at least 8 characters long.\n";
        }
        if (!/[0-9]/.test(password)) {
            errors += "Password must contain at least one number.\n";
        }
        if (!/[!@#$%^&*]/.test(password)) {
            errors += "Password must contain at least one special character.\n";
        }

        if (errors) {
            alert(errors);
            event.preventDefault();
        }
    };
};
