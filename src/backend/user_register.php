<?php
session_start();
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $role_id = $_POST["role_id"];

    // Call the insert_user function directly in PostgreSQL
    $query = "SELECT insert_user($1, $2, $3, $4, $5, 'N/A', 'N/A', $6, $7, $8)";
    $params = array($username, $hashed_password, $first_name, $middle_name, $last_name, $email, $phone_number, $role_id);
    $result = pg_query_params($conn, $query, $params);

    if ($result) {
        // Redirect or perform other actions after successful registration
        echo "<script>alert('USER ADDED SUCCESSFULLY');</script>";
        header("Location: ../frontend/login.php");
        exit();
    } else {
        // Handle error if the registration fails
        echo "Registration failed. Please try again.";
    }
}
