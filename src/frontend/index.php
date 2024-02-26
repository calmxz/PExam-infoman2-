<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}
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
            <a class="text-white hover:text-gray-300 px-4" href="index.php">Home</a>
            <a class="text-white hover:text-gray-300 px-4" href="shop.php">Shop</a>
            <a class="text-white hover:text-gray-300 px-4" href="#">Cart</a>
            <a class="text-white hover:text-gray-300 px-4" href="#">Profile</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="bg-gray-800 text-white py-20 px-6">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl font-bold mb-2">Welcome to Our Online Shop Store</h1>
        <p class="text-lg">Shop the latest trends and best deals!</p>
        <a href="#" class="mt-4 inline-block bg-white text-gray-800 font-semibold px-6 py-3 rounded-lg shadow">Shop Now</a>
    </div>
</div>

<!-- Featured Products -->
<div class="container mx-auto my-12">
    <h2 class="text-2xl font-semibold mb-6">Featured Products</h2>
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

<!-- Footer -->
<footer class="bg-gray-900 text-white py-6">
    <div class="container mx-auto text-center">
        <p>&copy; 2024 E-Commerce App. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
