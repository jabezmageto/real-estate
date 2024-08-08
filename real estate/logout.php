<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUser() {
    return [
        'id' => $_SESSION['user_id'],
        'username' => $_SESSION['username']
    ];
}

function loginUser($id, $username) {
    $_SESSION['user_id'] = $id;
    $_SESSION['username'] = $username;
}

function logoutUser() {
    session_destroy();
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    header("Location: login.php");
    exit(); // Ensure no further code is executed after redirection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Real Estate Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn {
            padding: 10px 20px;
            background-color: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #357abd;
        }

        h1 {
            margin-bottom: 20px;
            color: #4a90e2;
        }

        p {
            color: #666;
            margin: 10px 0;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our Real Estate Platform</h1>
        <p>Are you looking for your dream home or a perfect rental property? Our platform offers a wide variety of real estate options to meet your needs. Whether you are buying, selling, or renting, we provide a seamless and efficient experience to help you find the best property.</p>
        <p>Join us today to take advantage of:</p>
        <ul>
            <li>Comprehensive listings of properties for sale and rent.</li>
            <li>User-friendly interface and advanced search options.</li>
            <li>Expert advice and support from our dedicated team.</li>
            <li>Secure and transparent transactions.</li>
        </ul>
        <p>Don't wait any longer! Register now to get started or log in to access your account.</p>
        <a href="register.php" class="btn">Register</a>
        <a href="login.php" class="btn">Login</a>
    </div>
</body>
</html>
