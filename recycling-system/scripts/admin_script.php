<?php
// Start the session
session_start();

// Include database connection
include('includes/db.php');

// Check if user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Example: Get all users for admin management
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Fetch users data
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Example: Admin can delete a user
if (isset($_GET['delete_user_id'])) {
    $delete_user_id = $_GET['delete_user_id'];
    $delete_sql = "DELETE FROM users WHERE id = '$delete_user_id'";
    
    if (mysqli_query($conn, $delete_sql)) {
        echo "User deleted successfully!";
        header("Location: admin_management.php");
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);

// Display the users
echo json_encode($users);
?>
