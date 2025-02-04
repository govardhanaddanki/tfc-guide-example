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

// Check if pickup request is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $material = $_POST['material'];
    $pickup_date = $_POST['pickup_date'];

    // Insert pickup request into the database
    $sql = "INSERT INTO pickups (user_id, material, pickup_date) VALUES ('$user_id', '$material', '$pickup_date')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Pickup scheduled successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>
