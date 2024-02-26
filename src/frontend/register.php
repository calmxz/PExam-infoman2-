<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Add custom CSS styles here if needed */
        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto py-8">
    <h1 class="text-2xl text-center font-semibold mb-8">Registration</h1>

    <div class="form-container bg-white p-8 rounded shadow-md">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username:</label>
                <input type="text" id="username" name="username" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" id="email" name="email" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password:</label>
                <input type="password" id="password" name="password" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">Register</button>
        </form>
    </div>
</div>

</body>
</html>
