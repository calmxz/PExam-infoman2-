<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) && !isset($_SESSION['role_id'])) {
    // Redirect to login page
    header("Location: ../login.php");
    exit();
}

echo "<script>console.log('" . $_SESSION['user_id']. $_SESSION['role_id'] . "');</script>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<!-- Navigation -->
<nav class="bg-gray-900 p-6">
    <div class="container mx-auto flex justify-between items-center">
    <div class="text-xl text-white font-bold">Online Shop</div>
        <div>
            <a class="text-white hover:text-gray-300 px-4" href="welcome.php">Home</a>
            <a class="text-white hover:text-gray-300 px-4" href="#">Cart</a>
            <a class="text-white hover:text-gray-300 px-4" href="#">Profile</a>
            <a class="text-white hover:text-gray-300 px-4" href="../../backend/logout.php">Logout</a>
        </div>
    </div>
</nav>

<!-- Featured Products -->
<div class="container mx-auto my-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <!-- Product Card Example (Repeat as needed) -->
        <div class="bg-white rounded-lg overflow-hidden shadow-md">
            <img class="w-full h-56 object-cover object-center" src="https://via.placeholder.com/300" alt="Product Image">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Product Name</h3>
                <p class="text-gray-700">₱XX.XX</p>
                <button class="mt-4 w-full bg-gray-900 text-white font-semibold px-6 py-2 rounded-lg">Add to Cart</button>
            </div>
        </div>
        <!-- End Product Card Example -->
    </div>
</div>

</body>
</html>
