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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Real Estate Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        .section {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .property img {
            max-width: 100%;
            height: auto;
        }

        .btn {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background-color: #555;
        }

        .alert {
            background-color: #f9f9f9;
            color: #333;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin: 20px 0;
        }
    </style>
    <script>
        function handleAccountCheck() {
            // If user is not logged in
            if (confirm("You need to have an account to complete the payment. Do you want to create an account now?")) {
                window.location.href = "register.php";
            } else {
                window.location.href = "finalize-payment.php?id=" + <?php echo $property_id; ?>;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="section">
            <h2>Property Payment</h2>
            <img src="uploads/<?php echo htmlspecialchars($property['image']); ?>" alt="Property Image">
            <h3><?php echo htmlspecialchars($property['title']); ?></h3>
            <p><?php echo htmlspecialchars($property['description']); ?></p>
            <p>Price: $<?php echo htmlspecialchars($property['price']); ?></p>
            <p>Location: <?php echo htmlspecialchars($property['location']); ?></p>

            <?php if (isLoggedIn()): ?>
                <a href="finalize-payment.php?id=<?php echo $property_id; ?>" class="btn">Proceed to Finalize Payment</a>
            <?php else: ?>
                <button class="btn" onclick="handleAccountCheck()">Proceed to Payment</button>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
