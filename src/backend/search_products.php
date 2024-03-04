<?php
include 'dbconn.php'; // Include database connection

// Function to search products
function searchProducts($conn, $keyword) {
    // Prepare the search query
    $query = "SELECT * FROM search_products($1)";
    $params = array($keyword);
    
    // Execute the query
    $result = pg_query_params($conn, $query, $params);
    
    // Check if query was successful
    if ($result && pg_num_rows($result) > 0) {
        // Start output buffering to capture HTML markup
        ob_start();
        
        // Fetch and output search results as HTML cards
        while ($row = pg_fetch_assoc($result)) {
            echo '<div class="bg-white rounded-lg overflow-hidden shadow-md">';
            echo '<img class="w-full h-56 object-cover object-center" src="' . $row['image_link'] . '" alt="Product Image">';
            echo '<div class="p-4">';
            echo '<h3 class="text-lg font-semibold mb-2">' . $row['product_name'] . '</h3>';
            echo '<p class="text-gray-700">' . $row['stock'] . ' left</p>';
            echo '<p class="text-gray-700">₱' . number_format($row['unit_price'], 2) . '</p>';
            echo '<div class="flex justify-between mt-4">';
            echo '<a href="update_product.php?product_id=' . $row['product_id'] . '" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</a>';
            echo '<a href="#" onclick="confirmDelete(' . $row['product_id'] . ');" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        
        // Get the buffered content and clear the buffer
        $output = ob_get_clean();
        
        return $output;
    } else {
        // Set error message
        $error_message = "No products found matching the search keyword.";
        
        // Return error message
        return "<p class='text-red-500'>$error_message</p>";
    }
}

// Check if keyword is provided via GET request
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['keyword'])) {
    // Get the keyword and sanitize it
    $keyword = trim($_GET['keyword']);
    
    // Check if keyword is not empty
    if (!empty($keyword)) {
        // Call the searchProducts function to get search results
        $searchResults = searchProducts($conn, $keyword);
        
        // Output search results
        echo $searchResults;
    } else {
        // Empty keyword
        echo "<p class='text-red-500'>Please provide a search keyword.</p>";
    }
} else {
    // Invalid request method or keyword not provided
    echo "<p class='text-red-500'>Invalid request.</p>";
}