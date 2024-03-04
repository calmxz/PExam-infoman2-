<?php
// Retrieve product_id from the URL
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    // Redirect or display an error message
    header("Location: welcome.php");
    exit();
}

$product_id = $_GET['product_id'];

// Include database connection
include('../../backend/dbconn.php');

// Retrieve product details from the database
$query = "SELECT p.*, pi.image_link 
          FROM products p 
          LEFT JOIN product_images pi ON p.product_id = pi.product_id 
          WHERE p.product_id = $1";
$params = array($product_id);
$result = pg_query_params($conn, $query, $params);

if ($result && pg_num_rows($result) > 0) {
    // Product found, populate the $product variable with its details
    $product = pg_fetch_assoc($result);
} else {
    // Product not found or error occurred
    // Redirect or display an error message
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navigation -->
    <nav class="bg-gray-900 p-6">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl text-white font-bold">Online Shop</div>
            <div>
                <a class="text-white hover:text-gray-300 px-4" href="welcome.php">Home</a>
                <a class="text-white hover:text-gray-300 px-4" href="add_product.php">Add Product</a>
                <a class="text-white hover:text-gray-300 px-4" href="#">Profile</a>
                <a class="text-white hover:text-gray-300 px-4" href="../../backend/logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Update Product Form -->
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-lg">
            <h2 class="text-2xl font-semibold mb-6 text-center">Update Product</h2>
            <form action="../../backend/update_product.php?product_id=<?php echo $product_id; ?>" method="POST" class="w-full">
                <div class="mb-4">
                    <label for="product_name" class="block text-gray-700 text-sm font-bold mb-2">Product Name:</label>
                    <input type="text" id="product_name" name="product_name" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?= isset($product['product_name']) ? $product['product_name'] : '' ?>">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                    <input id="description" name="description" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?= isset($product['description']) ? $product['description'] : '' ?>"></input>
                </div>
                <div class="mb-4">
                    <label for="unit_price" class="block text-gray-700 text-sm font-bold mb-2">Unit Price:</label>
                    <input type="text" id="unit_price" name="unit_price" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?= isset($product['unit_price']) ? $product['unit_price'] : '' ?>">
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-gray-700 text-sm font-bold mb-2">Stock:</label>
                    <input type="number" id="stock" name="stock" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?= isset($product['stock']) ? $product['stock'] : '' ?>">
                </div>
                <div class="mb-4">
                    <label for="image_link" class="block text-gray-700 text-sm font-bold mb-2">Image URL:</label>
                    <input type="text" id="image_link" name="image_link" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?= isset($product['image_link']) ? $product['image_link'] : '' ?>">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Product</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>