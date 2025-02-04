<?php
// Start the session
session_start();

// Destroy the session to log the user out
session_unset();
session_destroy();

// Redirect to home page after logout
header("Location: home.php");
exit();
?>
