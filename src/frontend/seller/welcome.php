<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id'])) {
    // Redirect to login page
    header("Location: ../login.php");
    exit();
}

$error_message = ""; // Initialize error message variable

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
            <div class="text-xl text-white font-bold"><?php echo $_SESSION['shop_name']; ?></div>
            <div>
                <a class="text-white hover:text-gray-300 px-4" href="welcome.php">Home</a>
                <a class="text-white hover:text-gray-300 px-4" href="add_product.php">Add Product</a>
                <a class="text-white hover:text-gray-300 px-4" href="#">Profile</a>
                <a class="text-white hover:text-gray-300 px-4" href="../../backend/logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Welcome Message and Search Box -->
    <div class="container mx-auto flex justify-between items-center pt-6 px-6">
        <!-- Welcome Message -->
        <div>
            <div class="text-xl font-semibold text-left">
                <span>Welcome back,</span> <?php echo $_SESSION['username']; ?>!
            </div>
        </div>
        <!-- Search Box -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="flex">
            <input type="text" name="keyword" placeholder="Search products" class="py-2 px-4 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 transition duration-500">
            <button type="submit" class="bg-indigo-500 text-white py-2 px-4 rounded-md ml-2 hover:bg-indigo-700 transition duration-500">Search</button>
        </form>
    </div>

    <!-- Featured Products -->
    <div class="container mx-auto my-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php
            // Include the default products if no search keyword is provided
            if (!isset($_GET['keyword']) || empty(trim($_GET['keyword']))) {
                include '../../backend/products.php';
            } else {
                include '../../backend/search_products.php';
            }

            if (isset($products)) {
                foreach ($products as $product) {
                    // Display products as cards
                    echo '<div class="bg-white rounded-lg overflow-hidden shadow-md">';
                    echo '<img class="w-full h-56 object-cover object-center" src="' . $product['image_link'] . '" alt="Product Image">';
                    echo '<div class="p-4">';
                    echo '<h3 class="text-lg font-semibold mb-2">' . $product['product_name'] . '</h3>';
                    echo '<p class="text-gray-700">' . $product['stock'] . ' left</p>';
                    echo '<p class="text-gray-700">₱' . number_format($product['unit_price'], 2) . '</p>';
                    echo '<div class="flex justify-between mt-4">';
                    echo '<a href="update_product.php?product_id=' . $product['product_id'] . '" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</a>';
                    echo '<a href="#" onclick="confirmDelete(' . $product['product_id'] . ');" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p class='text-red-500'>$error_message</p>";
            }
            ?>
        </div>
    </div>

</body>

</html>