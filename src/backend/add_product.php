<?php
session_start();
include('dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $unit_price = $_POST['unit_price'];
    $stock = $_POST['stock'];
    $image_link = $_POST['image_link'];

    // Call the add_product_to_shop function
    $query = "SELECT add_product_to_shop($1, $2, $3, $4, $5, $6)";
    $params = array($_SESSION['shop_id'], $product_name, $description, $unit_price, $stock, $image_link);
    $result = pg_query_params($conn, $query, $params);

    if ($result) {
        // Product added successfully
        header("Location: ../frontend/seller/welcome.php"); // Redirect to success page
        exit();
    } else {
        // Error occurred
        $error_message = "An error occurred while adding the product.";
    }
}
