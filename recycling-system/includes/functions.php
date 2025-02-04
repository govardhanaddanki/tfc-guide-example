<?php
// /includes/functions.php

// Function to sanitize user input to prevent XSS and SQL injection
function sanitize_input($data) {
    $data = trim($data); // Remove extra spaces
    $data = stripslashes($data); // Remove backslashes
    $data = htmlspecialchars($data); // Convert special characters to HTML entities
    return $data;
}

// Function to check if a user is logged in (for protected pages)
function is_logged_in() {
    return isset($_SESSION['user_id']); // Check if user ID is set in the session
}

// Function to redirect user to a specific page
function redirect_to($url) {
    header("Location: $url");
    exit();
}

// Function to validate email format
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL); // Use PHP's built-in email validation
}

// Function to validate password strength
function validate_password($password) {
    if (strlen($password) < 8) {
        return false; // Password must be at least 8 characters long
    }
    return true;
}

// Function to check if a username exists in the database (for login)
function username_exists($username, $conn) {
    $query = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        return true; // Username exists
    }
    return false; // Username does not exist
}

// Function to check if an email exists in the database (for registration)
function email_exists($email, $conn) {
    $query = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        return true; // Email exists
    }
    return false; // Email does not exist
}

// Function to create a user record in the database
function create_user($username, $password, $email, $conn) {
    $password_hashed = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
    $query = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $username, $password_hashed, $email);
    return $stmt->execute(); // Return true if insertion is successful, false otherwise
}

// Function to authenticate user login
function authenticate_user($username, $password, $conn) {
    $query = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $stored_password);
        $stmt->fetch();
        
        // Verify if the provided password matches the hashed password stored in the database
        if (password_verify($password, $stored_password)) {
            $_SESSION['user_id'] = $user_id; // Store user ID in session
            return true; // Login successful
        }
    }
    return false; // Login failed
}

// Function to log out user by destroying session
function logout_user() {
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
}
?>
