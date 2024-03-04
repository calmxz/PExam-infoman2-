<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id'])) {
    // Redirect to login page
    header("Location: ../frontend/login.php");
    exit();
}

// Check if product_id is provided and is numeric
if (!isset($_GET['product_id']) || !is_numeric($_GET['product_id'])) {
    // Redirect or display an error message
    header("Location: ../frontend/seller/welcome.php");
    exit();
}

// Include the database connection
include('dbconn.php');

// Get the product_id from the GET data
$product_id = $_GET['product_id'];

// Call the PostgreSQL function to delete the product
$query = "SELECT delete_product($1)";
$params = array($product_id);
$result = pg_query_params($conn, $query, $params);

if ($result) {
    // Product deleted successfully
    // Redirect to the seller welcome page
    header("Location: ../frontend/seller/welcome.php");
    exit();
} else {
    // Error occurred while deleting the product
    // Redirect to the seller welcome page with an error message
    header("Location: ../frontend/seller/welcome.php?error=delete_failed");
    exit();
}