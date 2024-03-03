<?php
session_start();
include('dbconn.php');

// Check if login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Call the authenticate_user function
    $query = "SELECT authenticate_user($1, $2) AS user_data";
    $params = array($username, $password);
    $result = pg_query_params($conn, $query, $params);

    if ($result && pg_num_rows($result) > 0) {
        // Fetch user data
        $row = pg_fetch_assoc($result);
        $userData = json_decode($row['user_data'], true);

        if ($userData !== null) {
            // Verify the password using password_verify
            $hashedPasswordFromDB = $userData['hashed_password'];
            if (password_verify($password, $hashedPasswordFromDB)) {
                // Authentication successful, set user session with user_id and role_id
                $_SESSION['user_id'] = $userData['user_id'];
                $_SESSION['role_id'] = $userData['role_id'];

                // If user is a seller, store shop information in session
                if ($_SESSION['role_id'] == 1 && isset($userData['shop_id'])) {
                    $_SESSION['shop_id'] = $userData['shop_id'];
                }

                // Redirect based on role ID
                if ($_SESSION['role_id'] == 1) { // Seller
                    header("Location: ../frontend/seller/welcome.php");
                } else { // Customer or other roles
                    header("Location: ../frontend/customer/welcome.php");
                }
                exit();
            } else {
                // Password verification failed, set error message
                $error_message = "Invalid username or password. Please try again.";
            }
        } else {
            // Invalid user data returned, set error message
            $error_message = "Invalid username or password. Please try again.";
        }
    } else {
        // Error occurred or no user data returned, set error message
        $error_message = "An error occurred. Please try again.";
    }
}
