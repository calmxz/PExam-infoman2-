<?php
session_start();

include('dbconn.php');

// Function to update the product
function updateProduct($product_id, $product_name, $description, $unit_price, $stock, $image_link, $conn) {
    // Call the stored procedure to update the product
    $query = "SELECT update_product($1, $2, $3, $4, $5, $6)";
    $params = array($product_id, $product_name, $description, $unit_price, $stock, $image_link);
    $result = pg_query_params($conn, $query, $params);
    
    return $result;
}

// Check if user is logged in and is a seller
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    // Redirect to login page or unauthorized page
    header("Location: ../frontend/login.php");
    exit();
}

// Check if product_id is provided in the URL
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    // Redirect or display an error message
    header("Location: ../frontend/seller/welcome.php");
    exit();
}

// Retrieve product_id from the URL
$product_id = $_GET['product_id'];

// Retrieve updated product details from the form
if(isset($_POST['submit'])) {
    $new_product_details = array(
        'product_name' => $_POST['product_name'],
        'description' => $_POST['description'],
        'unit_price' => $_POST['unit_price'],
        'stock' => $_POST['stock'],
        'image_link' => $_POST['image_link']
    );

    // Update the product using the stored procedure
    $result = updateProduct(
        $product_id,
        $new_product_details['product_name'],
        $new_product_details['description'],
        $new_product_details['unit_price'],
        $new_product_details['stock'],
        $new_product_details['image_link'],
        $conn
    );

    if ($result) {
        // Product updated successfully
        header("Location: ../frontend/seller/welcome.php");
        exit();
    } else {
        // Error occurred
        $error_message = "An error occurred while updating the product.";
    }
}
