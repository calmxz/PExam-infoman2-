<?php
include('dbconn.php');
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to home page
    header("Location: index.php");
    exit();
}

// Check if login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username/email and password (not shown here for brevity)
    
    // Simulate user authentication (replace with your actual authentication logic)
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // If authentication succeeds, set user session
    $_SESSION['user_id'] = 1; 
    // Redirect to home page
    header("Location: index.php");
    exit();
}