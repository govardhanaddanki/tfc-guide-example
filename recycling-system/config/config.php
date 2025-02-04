<?php
// Database configuration settings
define('DB_SERVER', 'localhost');    // Database server (e.g., 'localhost')
define('DB_USERNAME', 'root');       // Database username (default is 'root' for local development)
define('DB_PASSWORD', '');           // Database password (leave blank for local development)
define('DB_NAME', 'recycling_db');   // Database name

// Site configuration
define('SITE_NAME', 'Recycling Management System');
define('SITE_URL', 'http://localhost/recycling-system');  // Adjust the URL if you're deploying elsewhere

// Admin email for system alerts
define('ADMIN_EMAIL', 'admin@example.com');

// Start the session
if (!session_id()) {
    session_start();
}

// Connect to the database
function connectDatabase() {
    // Create connection using mysqli
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

// Database Connection (This can be included in other PHP files)
$conn = connectDatabase();
?>
