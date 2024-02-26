<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded shadow-md w-full sm:w-96">
    <h1 class="text-2xl font-semibold mb-4">Login</h1>

    <form action="login.php" method="post">
        <div class="mb-4">
            <label for="username" class="block text-gray-700">Username/Email:</label>
            <input type="text" id="username" name="username" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password:</label>
            <input type="password" id="password" name="password" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500">
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-blue-300">Login</button>
    </form>

    <p class="mt-4">Don't have an account yet? <a href="register.php" class="text-blue-500">Sign up</a></p>
</div>

</body>
</html>
