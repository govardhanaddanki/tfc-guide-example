<?php
// Start the session
session_start();

// Include database connection
include('includes/db.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Retrieve user rewards from the database
$sql = "SELECT * FROM rewards WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

// Fetch rewards data
if (mysqli_num_rows($result) > 0) {
    $rewards = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $rewards = [];
}

// Close the connection
mysqli_close($conn);

// Display the rewards
echo json_encode($rewards);
?>
