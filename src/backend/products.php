<?php
include('dbconn.php');

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id'])) {
    // Redirect to login page
    header("Location: ../frontend/login.php");
    exit();
}

// Retrieve shop ID from session
$shop_id = $_SESSION['shop_id'];

// Call the get_seller_products function
$query = "SELECT * FROM get_seller_products($1)";
$params = array($shop_id);
$result = pg_query_params($conn, $query, $params);

if ($result && pg_num_rows($result) > 0) {
    // Products fetched successfully
    $products = pg_fetch_all($result);
} else {
    // No products found or error occurred
    $error_message = "No products found.";
}