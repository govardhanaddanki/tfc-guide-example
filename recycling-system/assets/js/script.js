// /assets/js/script.js

// DOMContentLoaded ensures the DOM is fully loaded before executing any scripts
document.addEventListener('DOMContentLoaded', function() {

    // Function for form validation on the registration page
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            let username = document.getElementById('username').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('confirmPassword').value;
            
            // Clear previous errors
            document.getElementById('errorMessages').innerHTML = '';

            let errors = [];

            // Username validation
            if (username.trim() === "") {
                errors.push("Username is required.");
            }

            // Email validation
            if (!validateEmail(email)) {
                errors.push("Please enter a valid email address.");
            }

            // Password validation
            if (password.length < 8) {
                errors.push("Password must be at least 8 characters.");
            }

            // Confirm password validation
            if (password !== confirmPassword) {
                errors.push("Passwords do not match.");
            }

            // If there are errors, prevent the form from submitting
            if (errors.length > 0) {
                event.preventDefault(); // Stop form submission
                let errorMessageDiv = document.getElementById('errorMessages');
                errors.forEach(error => {
                    let errorElement = document.createElement('p');
                    errorElement.classList.add('error');
                    errorElement.textContent = error;
                    errorMessageDiv.appendChild(errorElement);
                });
            }
        });
    }

    // Function to validate email format
    function validateEmail(email) {
        const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return re.test(String(email).toLowerCase());
    }

    // Example of an AJAX call for user login (could be used for the login form)
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            let username = document.getElementById('loginUsername').value;
            let password = document.getElementById('loginPassword').value;

            const data = new FormData();
            data.append('username', username);
            data.append('password', password);

            // Send data using fetch API
            fetch('login_script.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.text())
            .then(responseText => {
                if (responseText === 'success') {
                    window.location.href = 'dashboard_user.php'; // Redirect to user dashboard
                } else {
                    alert('Login failed. Please check your credentials.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error with the login process.');
            });
        });
    }

    // Example: Handle user logout by making a request to the logout script
    const logoutButton = document.getElementById('logoutButton');
    if (logoutButton) {
        logoutButton.addEventListener('click', function(event) {
            event.preventDefault();
            fetch('logout_script.php')
                .then(response => response.text())
                .then(responseText => {
                    if (responseText === 'success') {
                        window.location.href = 'home.php'; // Redirect to home page after logout
                    } else {
                        alert('Error logging out. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error logging out.');
                });
        });
    }
});
