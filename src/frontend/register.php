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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Add custom CSS styles here if needed */
        .form-container {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto py-8">
        <h1 class="text-2xl text-center font-semibold mb-8">Registration</h1>

        <div class="form-container bg-white p-8 rounded-lg shadow-md">
            <!-- Display error message if any -->
            <?php if (isset($error_message)) : ?>
                <div class="text-red-500 mb-4"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <!-- Registration form -->
            <form action="../backend/user_register.php" method="POST" id="registrationForm">

                <!-- Role selection section -->
                <div class="mt-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="role" name="role_id" class="border rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500">
                        <option value="2">Customer</option>
                        <option value="1">Seller</option>
                    </select>
                </div>
                <!-- Email section -->
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" class="border rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500">
                </div>
                <!-- Username section -->
                <div class="mt-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" class="border rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500">
                </div>
                <!-- Password section -->
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="border rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500">
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 flex items-center px-3 focus:outline-none">
                            <i id="eyeIcon" class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                </div>
                <!-- Phone number section -->
                <div class="mt-4">
                    <label for="phone-number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" id="phone-number" name="phone_number" class="border rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500">
                </div>
                <!-- Shop name section (initially hidden) -->
                <div id="shopSection" class="mt-4 hidden">
                    <label for="shop-name" class="block text-sm font-medium text-gray-700">Shop Name</label>
                    <input type="text" id="shop-name" name="shop_name" class="border rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500">
                </div>

                <!-- Shop location section (initially hidden) -->
                <div id="locationSection" class="mt-4 hidden">
                    <label for="shop-location" class="block text-sm font-medium text-gray-700">Shop Location</label>
                    <input type="text" id="shop-location" name="shop_location" class="border rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500">
                </div>
                <!-- Register button -->
                <div class="mt-8">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Register</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        // Function to show or hide shop name and location sections based on selected role
    function toggleShopSections() {
        const roleSelect = document.getElementById('role');
        const shopSection = document.getElementById('shopSection');
        const locationSection = document.getElementById('locationSection');

        if (roleSelect.value === '1') { // If role is Seller
            shopSection.classList.remove('hidden');
            locationSection.classList.remove('hidden');
        } else {
            shopSection.classList.add('hidden');
            locationSection.classList.add('hidden');
        }
    }

    // Call the function initially and whenever role selection changes
    toggleShopSections();
    document.getElementById('role').addEventListener('change', toggleShopSections);
    </script>

</body>

</html>