<?php
include 'config.php';
include 'session.php'; // Ensure session management is included

// Check if the property ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$property_id = intval($_GET['id']);

// Fetch property details from the database
$sql = "SELECT * FROM properties WHERE id = $property_id";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error executing query: " . $conn->error);
}

// Check if the property exists
if ($result->num_rows == 0) {
    die("Property not found.");
}

$property = $result->fetch_assoc();

// Fetch the contact email of the user (assuming it's stored in the users table)
$user_id = $property['user_id'];
$sql_user = "SELECT email FROM users WHERE id = $user_id";
$result_user = $conn->query($sql_user);

// Check if the query was successful
if ($result_user === false) {
    die("Error executing query: " . $conn->error);
}

// Check if the user exists
if ($result_user->num_rows == 0) {
    die("User not found.");
}

$user = $result_user->fetch_assoc();
$contact_email = htmlspecialchars($user['email']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase - Real Estate Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        .section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .section h2 {
            color: #4a90e2;
            margin-bottom: 20px;
            font-size: 2em;
        }

        .property {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .property img {
            max-width: 80%; /* Adjust the width as needed */
            height: auto;
            border-radius: 8px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .property h3 {
            color: #333;
            margin: 10px 0;
        }

        .property p {
            color: #666;
            margin: 10px 0;
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
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #357abd;
        }

        .alert {
            background-color: #fff;
            color: #333;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .section {
                padding: 10px;
            }

            .btn {
                padding: 8px 16px;
            }
        }
    </style>
    <script>
        function handleAccountCheck() {
            // If user is not logged in
            if (confirm("You need to have an account to complete the purchase. Do you want to create an account now?")) {
                window.location.href = "register.php";
            } else {
                window.location.href = "payments.php?id=" + <?php echo $property_id; ?>;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="section">
            <h2>Property Details</h2>
            <a href="index.php" class="btn">Back to Home</a>
            <div class="property">
                <img src="uploads/<?php echo htmlspecialchars($property['image']); ?>" alt="Property Image">
                <h3><?php echo htmlspecialchars($property['title']); ?></h3>
                <p><?php echo htmlspecialchars($property['description']); ?></p>
                <p>Price: $<?php echo htmlspecialchars($property['price']); ?></p>
                <p>Location: <?php echo htmlspecialchars($property['location']); ?></p>
                <p>Contact Us: <a href="mailto:<?php echo $contact_email; ?>" class="btn">Email us</a>  </p>
               <p>Call Us: <a href=""></a></p> 
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
