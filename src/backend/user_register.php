<?php
session_start();
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $role_id = $_POST["role_id"];

    // Initialize shop name and location variables
    $shop_name = "";
    $shop_location = "";

    // If role is Seller, retrieve shop name and location from form
    if ($role_id == 1) {
        $shop_name = $_POST["shop_name"];
        $shop_location = $_POST["shop_location"];
    }

    // Call the insert_user function directly in PostgreSQL
    $query = "SELECT insert_user($1, $2, '', '', '', '', '', $3, $4, $5)";
    $params = array($username, $hashed_password, $email, $phone_number, $role_id);
    $result = pg_query_params($conn, $query, $params);

    if ($result) {
        // If role is Seller, insert shop details using the insert_shop function
        if ($role_id == 1) {
            // Get the user_id of the newly registered user
            $user_id_query = "SELECT user_id FROM users WHERE username = $1";
            $user_id_result = pg_query_params($conn, $user_id_query, array($username));
            $user_id_row = pg_fetch_assoc($user_id_result);
            $user_id = $user_id_row['user_id'];

            // Call the insert_shop function to insert shop details
            $insert_shop_query = "SELECT insert_shop($1, $2, $3)";
            $insert_shop_params = array($shop_name, $shop_location, $user_id);
            $insert_shop_result = pg_query_params($conn, $insert_shop_query, $insert_shop_params);

            if (!$insert_shop_result) {
                // Handle error if shop details insertion fails
                echo "Shop details insertion failed. Please try again.";
                exit();
            }
        }

        // Redirect or perform other actions after successful registration
        header("Location: ../frontend/login.php");
        exit();
    } else {
        // Handle error if the registration fails
        echo "Registration failed. Please try again.";
    }
}
